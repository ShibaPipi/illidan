<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/25
 */
declare(strict_types=1);

namespace app\common\exception;

class UserNotFund extends ModelNotFound
{
    public $msg = '用户不存在';
}
