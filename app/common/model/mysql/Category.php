<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/27
 */
declare(strict_types=1);

namespace app\common\model\mysql;

class Category extends BaseModel
{
    /**
     * @param string $fields
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getAll(string $fields = '*')
    {
        return self::where('status', config('enum.category.status.normal'))
            ->field($fields)->select();
    }

    /**
     * @param array $where
     * @param int $size
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
    public function getList(array $where, int $size)
    {
        return self::where('status', '<>', config('enum.category.status.delete'))
            ->where($where)
            ->order([
                'sort' => 'desc',
                'id' => 'desc'
            ])
            ->paginate($size);
    }
}
