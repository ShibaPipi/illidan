<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/26
 */
declare(strict_types=1);

namespace app\api\controller;

use app\BaseController;
use app\common\service\User as UserService;

class Logout extends BaseController
{
    /**
     * @throws \app\common\exception\RedisException
     */
    public function index()
    {
        UserService::removeCache(request()->token);

        return api_success();
    }
}
