<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/23
 */
declare(strict_types=1);

namespace app\admin\controller;

use app\BaseController;

class Logout extends BaseController
{
    /**
     * @return \think\response\Redirect
     */
    public function index()
    {
        admin_session(null);

        return redirect((string)url('login/index'));
    }
}
