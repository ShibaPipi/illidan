<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\api\controller;

use app\api\exception\LoginException;
use app\api\validate\User as UserValidate;
use app\BaseController;
use app\common\exception\HttpValidateException;
use app\common\service\User as UserService;

class Login extends BaseController
{
    /**
     * @return \think\response\Json
     * @throws HttpValidateException
     * @throws LoginException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $validate = validate(UserValidate::class)->scene('login');
        if (!$validate->check(request()->only(['telephone', 'sms_code', 'login_type']))) {
            throw new HttpValidateException(['msg' => $validate->getError()]);
        }

        $result = (new UserService)->login();
        if (!$result) {
            throw new LoginException();
        }

        return api_success('登录成功', $result, 201);
    }
}
