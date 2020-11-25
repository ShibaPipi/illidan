<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/25
 */
declare(strict_types=1);

namespace app\common\exception;

class UpdateDataException extends BaseException
{
    public $code = 400;

    public $msg = '数据更新失败';

    public $errorCode = 10008;
}
