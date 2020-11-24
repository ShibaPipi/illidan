<?php
/**
 * 后台用户服务
 * User: sun.yaopeng
 * Date: 2020/11/23
 */
declare(strict_types=1);

namespace app\admin\service;

use app\admin\exception\LoginException;
use app\common\model\mysql\AdminUser as AdminUserModel;
use Exception;

class AdminUser
{
    /**
     * @return bool
     * @throws LoginException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function login(): bool
    {
        $adminUser = self::getByUsername(input('username'));
        if (empty($adminUser)) {
            throw new LoginException(['msg' => '该用户不存在']);
        }

        if ($adminUser->password != md5(input('password'))) {
            throw new LoginException(['msg' => '密码错误']);
        }

        if (!AdminUserModel::updateById($adminUser->id, [
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
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getByUsername(string $name)
    {
        $adminUser = AdminUserModel::getByUsername($name);
        return empty($adminUser) || !self::isNormal($adminUser->status)
            ? false : $adminUser;
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
