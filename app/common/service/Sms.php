<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\service;

use app\common\library\factory\Sms as SmsFactory;
use app\common\library\Num;

class Sms
{
    /**
     * @param string $telephone
     * @param int $len
     * @param string $type
     * @return bool
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \ReflectionException
     */
    public static function sendCode(string $telephone, int $len, string $type = 'ali'): bool
    {
        $code = Num::random($len);

        $result = SmsFactory::initClass($type)::sendCode($telephone, $code);
        if ($result) {
            cache(
                config('illidan.api.sms_code.prefix') . $telephone,
                $code,
                config('illidan.api.sms_code.expire')
            );
        }

        return $result;
    }
}
