<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/25
 */
declare(strict_types=1);

namespace app\api\exception;

use app\common\exception\BaseException;

class AuthException extends BaseException
{
    public $code = 422;

    public $msg = '未登录或者登录信息过期';

    public $errorCode = 10004;
}
