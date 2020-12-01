<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/24
 */

namespace app\common\library\factory;

class Sms extends ClassArr
{
    public static function aliases(): array
    {
        return [
            'ali' => \app\common\library\sms\Ali::class,
            'baidu' => \app\common\library\sms\Baidu::class,
            'jd' => \app\common\library\sms\Jd::class
        ];
    }
}
