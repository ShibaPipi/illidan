<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/27
 */
declare(strict_types=1);

namespace app\common\service;

use app\common\exception\ModelNotFoundException;
use app\common\model\mysql\Category as CategoryModel;

class Category
{
    public $model = null;

    public function __construct()
    {
        $this->model = new CategoryModel;
    }

    public function getList(array $where,int $size)
    {
        return $this->model->getList($where,$size);
    }

    /**
     * @return array
     * @throws ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAll(): array
    {
        $fields = 'id,name,pid';
        if (!$list = $this->model->getAll($fields)->toArray()) {
            throw new ModelNotFoundException(['msg' => '分类数据为空']);
        }
        return $list;
    }

    /**
     * @param array $data
     * @return int
     */
    public function store(array $data): int
    {
        $this->model->save($data);

        return (int)$this->model->id;
    }
}
