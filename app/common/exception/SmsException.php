<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/24
 */

namespace app\common\exception;


class SmsException extends BaseException
{
    public $code = 500;

    public $msg = '验证码发送失败';

    public $errorCode = 10007;
}