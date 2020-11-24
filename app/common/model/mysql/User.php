<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\model\mysql;

use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp = true;

    /**
     * @param string $username
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getByTelephone(string $telephone)
    {
        if (empty($telephone)) {
            return false;
        }
        return self::where(compact('telephone'))->find();
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function updateById(int $id, array $data)
    {
        if (empty($id) || empty($data)) {
            return false;
        }
        return self::where(compact('id'))->save($data);
    }
}
