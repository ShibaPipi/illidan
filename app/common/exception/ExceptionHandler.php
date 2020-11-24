<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/20
 */
declare(strict_types=1);

namespace app\common\exception;

use think\App;
use think\exception\Handle;
use think\Response;
use Throwable;

class ExceptionHandler extends Handle
{
    private $code = 500;

    private $msg = '内部服务器错误';

    private $errorCode = 999;

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
        if (env('app_debug')) {
            if ($e instanceof BaseException) {
                $this->code = $e->code;
                $this->msg = $e->msg;
                $this->errorCode = $e->errorCode;
            }
            return api_response($this->errorCode, $this->msg, [], $this->code);
        }

        return parent::render($request, $e);
    }
}
