<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\api\controller;

use app\api\exception\LoginException;
use app\api\validate\User;
use app\BaseController;
use app\common\exception\HttpValidateException;
use app\common\service\User as UserService;

class Login extends BaseController
{
    /**
     * @return \think\response\Json
     * @throws HttpValidateException
     * @throws LoginException
     */
    public function index()
    {
        $validate = validate(User::class)->scene('login');
        if (!$validate->check(request()->post(['telephone', 'sms_code', 'type']))) {
            throw new HttpValidateException(['msg' => $validate->getError()]);
        }

        $result = (new UserService)->login();
        if (!$result) {
            throw new LoginException();
        }

        return api_success('登录成功', 201, $result);
    }
}
