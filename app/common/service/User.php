<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\service;

use app\api\exception\LoginException;
use app\common\library\Token;
use app\common\model\mysql\User as UserModel;

class User
{
    public $user = null;

    public function __construct()
    {
        $this->user = new UserModel;
    }

    public function login()
    {
        $telephone = input('telephone');
        $cacheCode = cache(config('illidan.api.sms_code.prefix') . $telephone);
//        if (empty($cacheCode) || $cacheCode != input('sms_code')) {
//            throw new LoginException(['msg' => '验证码不正确']);
//        }

        $user = $this->user::getByTelephone($telephone);
        $data = [
            'last_login_ip' => request()->ip(),
            'last_login_time' => time()
        ];
        if (empty($user)) {
            $data += request()->post(['telephone', 'type']);
            $data += [
                'username' => '小蒜瓣儿-' . $telephone,
                'status' => config('enum.user.status.normal')
            ];
        }
        $user = $this->user->save($data);

        $token = Token::generateForLogin($telephone);
        $res = cache(config('illidan.api.token_prefix') . $token, [
            'user_id' => $user->id,
            'username' => $user->username
        ]);

        return $res ? ['token' => $token, 'username' => $user->username] : false;
    }
}
