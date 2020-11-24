<?php
/**
 * 后台用户验证
 * User: sun.yaopeng
 * Date: 2020/11/23
 */
declare(strict_types=1);

namespace app\admin\validate;

use think\Validate;

class AdminUser extends Validate
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
        if (!captcha_check($value)) {
            return '验证码错误';
        }
        return true;
    }
}
