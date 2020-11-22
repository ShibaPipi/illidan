<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/20
 */

namespace app\demo\middleware;

use Closure;

class Check
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
