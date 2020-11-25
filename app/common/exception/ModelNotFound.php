<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/25
 */
declare(strict_types=1);

namespace app\common\exception;

class ModelNotFound extends BaseException
{
    public $code = 404;

    public $msg = '模型不存在';

    public $errorCode = 10009;
}
