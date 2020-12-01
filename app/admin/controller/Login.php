<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/20
 */
declare(strict_types=1);

namespace app\admin\controller;

use app\admin\exception\LoginException;
use app\BaseController;
use app\admin\validate\AdminUser as AdminUserValidate;
use app\admin\service\AdminUser as AdminUserService;
use app\common\exception\HttpValidateException;
use think\response\Json;

class Login extends BaseController
{
    /**
     * 管理员登录，如果已经登录则跳转到首页
     * @return \think\response\Redirect|\think\response\View
     */
    public function index()
    {
        return admin_session() ? redirect((string)url('index/index')) : view();
    }

    /**
     * 登录验证
     * @return Json
     * @throws HttpValidateException
     * @throws LoginException
     * @throws \app\common\exception\ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function check(): Json
    {
        (new AdminUserValidate)->execute()
        && AdminUserService::login(input('username'), input('password'));

        return api_success('登录成功');
    }
}
