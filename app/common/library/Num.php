<?php
/**
 * 数字相关工具
 * Created By 皮神
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\library;

class Num
{
    public static function random(int $len = 4): int
    {
        return rand(pow(10, $len - 1), pow(10, $len) - 1);
    }
}
