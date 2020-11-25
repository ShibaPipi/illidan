<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/25
 */
declare(strict_types=1);

namespace app\common\exception;

class RedisException
{
    public $code = 500;

    public $msg = 'Redis 操作失败';

    public $errorCode = 10010;
}
