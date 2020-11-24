<?php
/**
 * 用户登录中间件
 * User: sun.yaopeng
 * Date: 2020/11/23
 */
declare(strict_types=1);

namespace app\admin\middleware;

use Closure;
use app\Request;

class Auth
{
    public function handle(Request $request, Closure $next)
    {
        if (empty(admin_session()) && false === strpos($request->pathinfo(), 'login')) {
            return redirect((string)url('login/index'));
        }
        if (admin_session() && false !== strpos($request->pathinfo(),'login')) {
            return redirect((string)url('index/index'));
        }
        return $next($request);
    }
}
