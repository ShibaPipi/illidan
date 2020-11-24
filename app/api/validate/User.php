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
    ];

    protected $message = [
        'username' => '用户名必须填写',
        'telephone' => '手机号必须填写',
    ];

    protected $scene = [
        'send_code' => ['telephone']
    ];
}
