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
        'username' => 'require|unique:User',
        'telephone' => 'require',
        'sms_code' => 'require|number|min:4',
        'login_type' => 'require|in:1,2',
        'gender' => 'require|in:0,1,2'
    ];

    protected $message = [
        'username.require' => '用户名必须填写',
        'username.unique' => '用户名已经存在',
        'telephone.require' => '手机号必须填写',
        'sms_code.require' => '短信验证码必须填写',
        'sms_code.number' => '短信验证码必须为数字',
        'sms_code.min' => '短信验证码不能少于4位',
        'login_type.require' => '类型必须填写',
        'login_type.in' => '类型数值错误',
        'gender.require' => '性别必须填写',
        'gender.in' => '性别数值错误'
    ];

    protected $scene = [
        'send_code' => ['telephone'],
        'login' => ['telephone', 'sms_code', 'login_type'],
        'update' => ['username', 'gender']
    ];
}
