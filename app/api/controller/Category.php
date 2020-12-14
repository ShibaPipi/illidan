<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/30
 */

namespace app\api\controller;

use app\BaseController;
use think\App;
use app\common\service\Category as CategoryService;

class Category extends BaseController
{
    protected $service = null;

    public function __construct(App $app, CategoryService $service)
    {
        $this->service = $service;
        parent::__construct($app);
    }

    public function index()
    {
        $result = $this->service->sliceArborescent();

        return api_success('ok', $result);
    }
}
