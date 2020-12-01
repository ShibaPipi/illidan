<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\library\sms;

interface SmsInterface
{
    /**
     * 发送短信验证码
     * @param string $phone
     * @param int $code
     * @return bool
     */
    public static function sendCode(string $phone, int $code): bool;
}
