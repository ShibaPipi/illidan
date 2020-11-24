<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/20
 */
declare(strict_types=1);

namespace app\admin\controller;

use app\admin\exception\LoginException;
use app\BaseController;
use app\admin\validate\AdminUser as AdminUserRule;
use app\admin\service\AdminUser as AdminUserService;
use app\common\exception\HttpValidateException;
use app\common\exception\InvalidRequestMethodException;

class Login extends BaseController
{
    /**
     * @return \think\response\View
     */
    public function index()
    {
        return view();
    }

    /**
     * 登录验证
     * @return \think\response\Json
     * @throws HttpValidateException
     * @throws InvalidRequestMethodException
     * @throws LoginException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function check()
    {
        if (!$this->request->isPost()) {
            throw new InvalidRequestMethodException();
        }

        $validate = new AdminUserRule;
        if (!$validate->check(request()->post(['username', 'password', 'captcha']))) {
            throw new HttpValidateException(['msg' => $validate->getError()]);
        }

        if (!AdminUserService::login()) {
            throw new LoginException(['msg' => '内部异常，登录失败']);
        }

        return api_success('登录成功');
    }
}
