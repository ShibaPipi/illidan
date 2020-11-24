<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\library\sms;

class Baidu implements SmsInterface
{
    public static function sendCode(string $phone, int $code): bool
    {
        return true;
    }
}
