<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\service;

use app\common\exception\RedisException;
use app\common\exception\UpdateDataException;
use app\common\exception\UserNotFund;
use app\common\library\Time;
use app\common\library\Token;
use app\common\model\mysql\User as UserModel;
use think\facade\Db;

class User
{
    public $user = null;

    public function __construct()
    {
        $this->user = new UserModel;
    }

    /**
     * @return array
     * @throws RedisException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function login()
    {
        $telephone = input('telephone', '', 'trim');
        $days = input('remember_days', '', 'intval');
        $cacheCode = cache(config('illidan.api.sms_code.prefix') . $telephone);
//        if (!$cacheCode || $cacheCode != input('sms_code')) {
//            throw new LoginException(['msg' => '验证码不正确']);
//        }
        $timestamp = time();
        $user = $this->user::getByTelephone($telephone);
        $data = [
            'remember_days' => $days,
            'update_time' => $timestamp,
            'last_login_ip' => request()->ip(),
            'last_login_time' => $timestamp
        ];
        if (!$user) {
            $data += request()->post(['telephone', 'login_type']);
            $username = '小蒜瓣儿_' . $telephone;
            $data += [
                'username' => $username,
                'status' => config('enum.user.status.normal'),
                'create_time' => $timestamp
            ];
            $id = $this->user->insertGetId($data);
        } else {
            $id = $user->id;
            $this->user::updateById($id, $data);
            $username = $user->username;
        }

        $token = Token::generateForLogin($telephone);
        self::saveToCache($token, compact('id', 'username', 'days'), $days);

        return compact('token', 'username');
    }

    /**
     * @param int $id
     * @return array
     * @throws UserNotFund
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUserById(int $id): array
    {
        $user = $this->user::getUserById($id);
        if (!$user) {
            throw new UserNotFund();
        }

        return $user->toArray();
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     * @throws RedisException
     * @throws UpdateDataException
     */
    public function update(int $id, array $data): bool
    {
        Db::transaction(function () use ($id, $data) {
            $token = request()->token;
            $rememberDays = self::getCache($token)['days'];
            $this->user::updateById($id, $data);
            self::saveToCache($token, [
                'id' => $id,
                'username' => $data['username'],
                'days' => $rememberDays
            ], $rememberDays);
        });

        return true;
    }

    /**
     * 获取 redis 中的用户信息
     * @param string $token
     * @return array
     * @throws RedisException
     */
    public static function getCache(string $token): array
    {
        $user = cache(config('illidan.api.token_prefix') . $token);
        if (!$user) {
            throw new RedisException(['msg' => '用户数据缓获取失败']);
        }
        return $user;
    }

    /**
     * 将用户信息写入 redis
     * @param string $token
     * @param array $data
     * @param int $days
     * @return bool
     * @throws RedisException
     */
    public static function saveToCache(string $token, array $data, int $days): bool
    {
        if (!cache(config('illidan.api.token_prefix') . $token,
            $data, Time::userExpireAt($days))
        ) {
            throw new RedisException(['msg' => '用户数据缓存写入失败']);
        }
        return true;
    }

    /**
     * 从 redis 清除用户信息
     * @param string $token
     * @return bool
     * @throws RedisException
     */
    public static function removeCache(string $token): bool
    {
        if (!cache(config('illidan.api.token_prefix') . $token, null)) {
            throw new RedisException(['msg' => '用户数据缓存清除失败']);
        }
        return true;
    }
}
