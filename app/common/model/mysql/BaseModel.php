<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/27
 */
declare(strict_types=1);

namespace app\common\model\mysql;

use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;
}
