<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/25
 */
declare(strict_types=1);

namespace app\common\exception;

class ModelNotFoundException extends BaseException
{
    public $code = 404;

    public $msg = '模型不存在';

    public $errorCode = 10009;
}
