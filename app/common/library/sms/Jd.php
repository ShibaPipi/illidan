<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */

namespace app\common\library\sms;

class Jd implements SmsInterface
{
    public static function sendCode(string $phone, int $code): bool
    {
        return true;
    }
}
