<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/21
 */

namespace app\common\model\mysql;

use think\Model;

class AdminUser extends Model
{
    /**
     * @param string $username
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getByUsername(string $username)
    {
        if (empty($username)) {
            return false;
        }
        return self::where(compact('username'))->find();
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
