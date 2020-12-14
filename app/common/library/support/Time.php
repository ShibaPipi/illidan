<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/25
 */
declare(strict_types=1);

namespace app\common\library\support;

class Time
{
    /**
     * 用户登录态过期时间
     * @param int $type
     * @return int
     */
    public static function userExpireAt(int $type = 2): int
    {
        switch ($type) {
            case 1:
                $days = 7;
                break;
            default:
                $days = 30;
                break;
        }
        return $days * 24 * 3600;
    }
}
