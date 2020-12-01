<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/23
 */

namespace app\api\exception;

use app\common\exception\BaseException;

class LoginException extends BaseException
{
    public $code = 400;

    public $msg = '登录失败';

    public $errorCode = 10006;
}