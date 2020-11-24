<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/23
 */

namespace app\demo\exception;

use app\common\exception\BaseException;

class LoginException extends BaseException
{
    public $code = 401;

    public $msg = '登录失败';

    public $errorCode = 10006;
}