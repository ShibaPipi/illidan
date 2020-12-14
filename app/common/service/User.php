<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\service;

use app\common\exception\ModelNotFoundException;
use app\common\exception\RedisException;
use app\common\exception\UpdateDataException;
use app\common\library\support\Time;
use app\common\library\Token;
use app\common\model\mysql\User as UserModel;
use think\facade\Db;

class User
{
    public $model = null;

    public function __construct()
    {
        $this->model = new UserModel;
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
        $data = [
            'remember_days' => $days,
            'last_login_ip' => request()->ip(),
            'last_login_time' => $timestamp
        ];
        if (!$user = $this->model::getByTelephone($telephone)) {
            $user = $this->model;
            $data += request()->only(['telephone', 'login_type']);
            $data += ['username' => '小蒜瓣儿_' . $telephone];
        }
        $user->save($data);
        $id = $user->id;
        $username = $user->username;

        $token = Token::generateForLogin($telephone);
        self::saveToCache($token, compact('id', 'username', 'days'), $days);

        return compact('token', 'username');
    }

    /**
     * @param int $id
     * @return array
     * @throws ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUserById(int $id): array
    {
        if (!$user = $this->model::getById($id)) {
            throw new ModelNotFoundException(['msg' => '用户不存在']);
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
            $this->model::updateById($id, $data);
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
        if (!$user = cache(config('illidan.api.token_prefix') . $token)) {
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
