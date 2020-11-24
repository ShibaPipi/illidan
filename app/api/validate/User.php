<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\api\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username' => 'require',
        'telephone' => 'require',
        'sms_code' => 'require|number|min:4',
        'type' => 'require|in:1,2'
    ];

    protected $message = [
        'username' => '用户名必须填写',
        'telephone' => '手机号必须填写',
        'sms_code.require' => '短信验证码必须填写',
        'sms_code.number' => '短信验证码必须为数字',
        'sms_code.min' => '短信验证码不能少于4位',
        'type.require' => '类型必须填写',
        'type.in' => '类型数值错误'
    ];

    protected $scene = [
        'send_code' => ['telephone'],
        'login' => ['telephone', 'sms_code', 'type']
    ];
}
