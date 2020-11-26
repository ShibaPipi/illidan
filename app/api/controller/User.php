<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/25
 */
declare(strict_types=1);

namespace app\api\controller;

use app\BaseController;
use app\common\exception\HttpValidateException;
use app\common\exception\UpdateDataException;
use app\common\service\User as UserService;
use app\api\validate\User as UserValidate;
use think\App;
use think\response\Json;

class User extends BaseController
{
    protected $userId = 0;
    protected $userService = null;

    public function __construct(App $app, UserService $userService)
    {
        $this->userId = intval(request()->userId);
        $this->userService = $userService;
        parent::__construct($app);
    }

    /**
     * @return Json
     * @throws \app\common\exception\UserNotFund
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function info(): Json
    {
        $user = $this->userService->getUserById($this->userId);

        return api_success('ok', $user);
    }

    /**
     * @return Json
     * @throws HttpValidateException
     * @throws UpdateDataException
     * @throws \app\common\exception\RedisException
     */
    public function update(): Json
    {
        $id = $this->userId;
        $username = input('username', '', 'trim');
        $gender = input('gender', 0, 'intval');
        $validate = validate(UserValidate::class)->scene('update');
        if (!$validate->check(compact('id','username', 'gender'))) {
            throw new HttpValidateException(['msg' => $validate->getError()]);
        }

        $this->userService->update($this->userId, compact('username', 'gender'));

        return api_success();
    }
}
