<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/26
 */
declare(strict_types=1);

namespace app\admin\controller;

use app\BaseController;
use app\admin\validate\Category as CategoryValidate;
use app\common\service\Category as CategoryService;

class Category extends BaseController
{
    public function index()
    {
        $list = (new CategoryService)->getList(request()->only(['pid']), 5);

        return view('', compact('list'));
    }

    /**
     * @return \think\response\View
     * @throws \app\common\exception\ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function create()
    {
        $list = json_encode((new CategoryService)->getAll());

        return view('', compact('list'));
    }

    /**
     * @return \think\response\Json
     * @throws \app\common\exception\HttpValidateException
     */
    public function save()
    {
        (new CategoryValidate)->execute()
        && (new  CategoryService)->store(request()->only(['name', 'pid']));

        return api_success();
    }
}
