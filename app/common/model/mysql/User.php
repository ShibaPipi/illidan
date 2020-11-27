<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\model\mysql;

class User extends BaseModel
{
    /**
     * @param string $username
     * @return array|bool|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getByTelephone(string $telephone)
    {
        return self::where(compact('telephone'))->find();
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

    /**
     * @param int $id
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getUserById(int $id)
    {
        return self::where('status', config('enum.user.status.normal'))->find($id);
    }
}
