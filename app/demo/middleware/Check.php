<?php
/**
 *
 * Created By 皮神
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
