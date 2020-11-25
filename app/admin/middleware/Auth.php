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
    /**
     * 根据 session 判断用户是否登录
     * @param Request $request
     * @param Closure $next
     * @return mixed|\think\response\Redirect
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty(admin_session())) {
            return redirect((string)url('login/index'));
        }
        return $next($request);
    }
}
