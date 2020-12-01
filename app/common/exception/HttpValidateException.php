<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/24
 */

namespace app\common\exception;


class HttpValidateException extends BaseException
{
    public $code = 400;

    public $msg = '参数错误';

    public $errorCode = 10001;
}
