<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/27
 */
declare(strict_types=1);

namespace app\common\service;

use app\common\exception\HttpValidateException;
use app\common\exception\ModelNotFoundException;
use app\common\exception\UpdateDataException;
use app\common\library\Arr;
use app\common\model\mysql\Category as CategoryModel;

class Category
{
    public $model = null;

    public function __construct()
    {
        $this->model = new CategoryModel;
    }

    /**
     * @param array $where
     * @param int $size
     * @return array
     * @throws \think\db\exception\DbException
     */
    public function getList(array $where, int $size): array
    {
        $result = $this->model::getList($where, $size)->toArray();
        if ($result['data']) {
            $pids = array_column($result['data'], 'id');
            $idCounts = $this->model::getChildCountInPids(compact('pids'))->toArray();
            $countMap = [];
            foreach ($idCounts as $item) {
                $countMap[$item['pid']] = $item['count'];
            }
            foreach ($result['data'] as $k => $v) {
                $result['data'][$k]['children_num'] = $countMap[$v['id']] ?? 0;
            }
        }
        return $result;
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

    /**
     * @param int $id
     * @param int $sort
     * @return bool
     * @throws HttpValidateException
     * @throws UpdateDataException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function sort(int $id, int $sort)
    {
        $model = $this->model->find($id);
        if ($model->sort === $sort) {
            throw new HttpValidateException(['msg' => '新排序和原排序值不能相同']);
        }
        $model->sort = $sort;
        if (!$model->save()) {
            throw new UpdateDataException();
        }
        return true;
    }

    /**
     * @param int $id
     * @param int $status
     * @return bool
     * @throws HttpValidateException
     * @throws UpdateDataException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function status(int $id, int $status): bool
    {
        $model = $this->model->find($id);
        if ($model->status === $status) {
            throw new HttpValidateException(['msg' => '原状态和新状态不能相同']);
        }
        $model->status = $status;
        if (!$model->save()) {
            throw new UpdateDataException();
        }
        return true;
    }

    /**
     * @param int $id
     * @param string $name
     * @return bool
     * @throws UpdateDataException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function name(int $id, string $name): bool
    {
        $model = $this->model->find($id);
        $model->name = $name;
        if (!$model->save()) {
            throw new UpdateDataException();
        }
        return true;
    }

    /**
     * @param int $first
     * @param int $second
     * @param int $third
     * @return array
     * @throws ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function sliceArborescent(int $first = 5, int $second = 3, int $third = 6): array
    {
        $data = array_slice(Arr::arborescent($this->getAll()), 0, $first);
        foreach ($data as $k => $v) {
            if (!empty($v['children'])) {
                $data[$k]['children'] = array_slice($v['children'], 0, $second);
                foreach ($v['children'] as $kk => $vv) {
                    if (!empty($vv['children'])) {
                        $data[$k]['children'][$kk]['children'] = array_slice($vv['children'], 0, $third);
                    }
                }
            }
        }
        return $data;
    }
}
