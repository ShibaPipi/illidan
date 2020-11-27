<?php
/**
 * 后台用户服务
 * User: sun.yaopeng
 * Date: 2020/11/23
 */
declare(strict_types=1);

namespace app\admin\service;

use app\admin\exception\LoginException;
use app\common\exception\ModelNotFoundException;
use app\common\model\mysql\AdminUser as AdminUserModel;

class AdminUser
{
    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws LoginException
     * @throws ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function login(string $username, string $password): bool
    {
        $adminUser = self::getByUsername($username);
        if ($adminUser['password'] != md5($password)) {
            throw new LoginException(['msg' => '密码错误']);
        }

        if (!AdminUserModel::updateById($adminUser['id'], [
            'last_login_ip' => request()->ip(),
            'last_login_time' => time()

        ])) {
            throw new LoginException();
        }
        admin_session($adminUser);

        return true;
    }

    /**
     * 获取管理员信息
     * @param string $name
     * @return array|bool|\think\Model|null
     * @throws ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getByUsername(string $name)
    {
        if (!$adminUser = AdminUserModel::getByUsername($name)) {
            throw new ModelNotFoundException(['msg' => '该用户不存在']);
        }
        return $adminUser->toArray();
    }

    /**
     * 判断管理员状态是否正常
     * @param int $status
     * @return bool
     */
    public static function isNormal(int $status): bool
    {
        return $status === config('enum.admin_user.status.normal');
    }
}
