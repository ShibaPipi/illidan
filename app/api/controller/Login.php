<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\api\controller;

use app\api\exception\LoginException;
use app\api\validate\User as UserValidate;
use app\BaseController;
use app\common\exception\HttpValidateException;
use app\common\service\User as UserService;

class Login extends BaseController
{
    /**
     * @return \think\response\Json
     * @throws HttpValidateException
     * @throws LoginException
     * @throws \app\common\exception\RedisException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        (new UserValidate)->scene('login')->execute();

        if (!$result = (new UserService)->login()) {
            throw new LoginException();
        }

        return api_success('登录成功', $result, 201);
    }
}
