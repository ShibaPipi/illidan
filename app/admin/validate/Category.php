<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/26
 */
declare(strict_types=1);

namespace app\admin\validate;

use app\common\validate\BaseValidate;

class Category extends BaseValidate
{
    protected $rule = [
        'name' => 'require|unique:Category',
        'pid' => 'require'
    ];

    protected $message = [
        'name' => '分类名称必填',
        'name.unique' => '分类名已经存在',
        'pid' => '父级 id 必填'
    ];
}
