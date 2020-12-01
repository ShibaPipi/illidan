<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/26
 */
declare(strict_types=1);

namespace app\admin\controller;

use app\BaseController;
use app\admin\validate\Category as CategoryValidate;
use app\common\service\Category as CategoryService;
use think\response\Json;
use think\response\View;

class Category extends BaseController
{
    /**
     * @return View
     */
    public function index(): View
    {
        $pid = input('pid', 0, 'intval');
        $list = (new CategoryService)->getList(compact('pid'), 5);

        return view('', compact('list', 'pid'));
    }

    /**
     * @return View
     * @throws \app\common\exception\ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function create(): View
    {
        $list = json_encode((new CategoryService)->getAll());

        return view('', compact('list'));
    }

    /**
     * @return Json
     * @throws \app\common\exception\HttpValidateException
     */
    public function save(): Json
    {
        (new CategoryValidate)->execute()
        && (new  CategoryService)->store(request()->only(['name', 'pid']));

        return api_created_or_updated();
    }

    /**
     * @return Json
     * @throws \app\common\exception\HttpValidateException
     * @throws \app\common\exception\UpdateDataException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function sort(): Json
    {
        (new CategoryValidate)->scene('sort')->execute()
        && (new CategoryService)->sort((int)input('id'), (int)input('sort'));

        return api_created_or_updated();
    }

    /**
     * @return Json
     * @throws \app\common\exception\HttpValidateException
     * @throws \app\common\exception\UpdateDataException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function status(): Json
    {
        (new CategoryValidate)->scene('status')->execute()
        && (new CategoryService)->status((int)input('id'), (int)input('status'));

        return api_created_or_updated();
    }

    /**
     * @return Json
     * @throws \app\common\exception\HttpValidateException
     * @throws \app\common\exception\UpdateDataException
     */
    public function name(): Json
    {
        (new CategoryValidate)->scene('name')->execute()
        && (new CategoryService)->name((int)input('id'), input('name'));

        return api_created_or_updated();
    }
}
