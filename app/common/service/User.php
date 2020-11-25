<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\service;

use app\api\exception\LoginException;
use app\common\exception\UpdateDataException;
use app\common\exception\UserNotFund;
use app\common\library\Time;
use app\common\library\Token;
use app\common\model\mysql\User as UserModel;

class User
{
    public $user = null;

    public function __construct()
    {
        $this->user = new UserModel;
    }

    /**
     * @return array|bool
     * @throws LoginException
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
        $res = cache(config('illidan.api.token_prefix') . $token,
            compact('id', 'username'),
            Time::userExpireAt($days));

        return $res ? compact('token', 'username') : false;
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
     * @throws UpdateDataException
     */
    public function update(int $id, array $data): bool
    {
        if (!$this->user::updateById($id, $data) ) {
            throw new UpdateDataException();
        }
//        TODO: 更新 redis 中的用户信息
        return true;
    }
}
