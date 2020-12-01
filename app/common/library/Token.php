<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\library;

class Token
{
    public static function generateForLogin(string $str): string
    {
        $randomStr = md5(uniqid(md5(strval(microtime(true))), true));
        return sha1($randomStr . $str);
    }
}
