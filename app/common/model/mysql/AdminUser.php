<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/21
 */

namespace app\common\model\mysql;

class AdminUser extends BaseModel
{
    /**
     * @param string $username
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getByUsername(string $username)
    {
        return self::where(compact('username'))
            ->where('status', config('enum.admin_user.status.normal'))
            ->find();
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function updateById(int $id, array $data)
    {
        return self::where(compact('id'))->save($data);
    }
}
