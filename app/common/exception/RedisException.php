<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/25
 */
declare(strict_types=1);

namespace app\common\exception;

class RedisException extends BaseException
{
    public $code = 500;

    public $msg = 'Redis 操作失败';

    public $errorCode = 10010;
}
