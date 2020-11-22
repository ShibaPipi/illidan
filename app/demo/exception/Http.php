<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/20
 */

namespace app\demo\exception;

use think\exception\Handle;
use think\Response;
use Throwable;

class Http extends Handle
{
    public $httpStatus = 500;

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        // 添加自定义异常处理机制
        $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : $this->httpStatus;
        return api_response(config('code.error'), $e->getMessage(), [], $statusCode);
    }
}
