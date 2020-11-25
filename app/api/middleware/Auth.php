<?php
/**
 * 用户登录中间件
 * User: sun.yaopeng
 * Date: 2020/11/23
 */
declare(strict_types=1);

namespace app\api\middleware;

use app\api\exception\AuthException;
use Closure;
use app\Request;

class Auth
{
    public $accessToken = '';

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthException
     */
    public function handle(Request $request, Closure $next)
    {
        $this->accessToken = request()->header('access-token');
        if (!$this->accessToken || !$this->isLogin()) {
            throw new AuthException();
        }
        return $next($request);
    }

    /**
     * 判断用户是否登录
     * @return bool
     */
    protected function isLogin(): bool
    {
        $user = cache(config('illidan.api.token_prefix') . $this->accessToken);
        if (!empty($user['id']) && !empty($user['username'])) {
            request()->userId = $user['id'];
            request()->username = $user['username'];

            return true;
        }
        return false;
    }
}
