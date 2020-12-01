<?php
/**
 * 后台用户验证
 * Created By 皮神
 * Date: 2020/11/23
 */
declare(strict_types=1);

namespace app\admin\validate;

use app\common\validate\BaseValidate;

class AdminUser extends BaseValidate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'captcha' => 'require|checkCaptcha'
    ];

    protected $message = [
        'username' => '用户名必填',
        'password' => '密码必填',
        'captcha' => '验证码必填'
    ];

    /**
     * @param string $value
     * @return bool|string
     */
    protected function checkCaptcha(string $value)
    {
        return captcha_check($value) ?: '验证码错误';
    }
}
