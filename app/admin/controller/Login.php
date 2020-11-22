<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/20
 */

namespace app\admin\controller;

use app\BaseController;
use app\common\model\mysql\AdminUser;
use Exception;

class Login extends BaseController
{
    public function index()
    {
        return view();
    }

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function check()
    {
        if (!$this->request->isPost()) {
            return api_response(config('code.error'), '请求方式错误');
        }

        ['username' => $username, 'password' => $password, 'captcha' => $captcha] = $this->request->post();
        if (empty($username) || empty($password) || empty($captcha)) {
            return api_response(config('code.error'), '参数不能为空');
        }

        if (!captcha_check($captcha)) {
            return api_response(config('code.error'), '验证码不正确');
        }

        try {
            $adminUser = AdminUser::getByUsername($username);
            if (empty($adminUser) || $adminUser->status != config('enum.admin_user.status.normal')) {
                return api_response(config('code.error'), '该用户不存在');
            }

            if ($adminUser->password != md5($password)) {
                return api_response(config('code.error'), '密码错误');
            }

            if (!AdminUser::updateById($adminUser->id, [
                'last_login_ip' => $this->request->ip(),
                'last_login_time' => time()
            ])) {
                return api_response(config('code.error'), '登录失败');
            }
        } catch (Exception $e) {
            // todo: 记录日志
            return api_response(config('code.error'), '内部异常，登录失败');
        }

        session(config('illidan.admin.session_name'), $adminUser);

        return api_response(config('code.success'), '登录成功');
    }
}
