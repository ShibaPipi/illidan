<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/23
 */

namespace app\common\exception;

class InvalidRequestMethodException extends BaseException
{
    protected $code = 400;

    protected $msg = '请求方式错误';

    protected $errorCode = 10003;
}
