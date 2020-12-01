<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/26
 */
declare(strict_types=1);

namespace app\admin\validate;

use app\common\validate\BaseValidate;

class Category extends BaseValidate
{
    protected $rule = [
        'id' => 'require|number',
        'name' => 'require|unique:Category',
        'pid' => 'require',
        'status' => 'require|in:0,1,99',
        'sort' => 'require|number'
    ];

    protected $message = [
        'id.require' => '分类 id 必填',
        'id.number' => 'id 必须是数字',
        'name.require' => '分类名称必填',
        'name.unique' => '分类名已经存在',
        'pid.require' => '父级 id 必填',
        'status.require' => '分类状态值必填',
        'status.in' => '分类状态值错误',
        'sort.require' => '排序必填',
        'sort.number' => '排序必须是数字'
    ];

    protected $scene = [
        'sort' => ['id', 'sort'],
        'status' => ['id', 'status'],
        'name' => ['id', 'name']
    ];
}
