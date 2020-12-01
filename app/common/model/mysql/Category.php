<?php
/**
 *
 * Created By 皮神
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
            ->field($fields)
            ->order([
                'pid' => 'asc',
                'sort' => 'desc',
                'id' => 'desc'
            ])
            ->select();
    }

    /**
     * @param array $where
     * @param int $size
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
    public static function getList(array $where, int $size)
    {
        return self::where('status', '<>', config('enum.category.status.delete'))
            ->where($where)
            ->order([
                'sort' => 'desc',
                'id' => 'desc'
            ])
            ->paginate($size);
    }

    /**
     * @param array $where
     * @return mixed
     */
    public static function getChildCountInPids(array $where)
    {
        return self::where('pid', 'in', $where['pids'])
            ->where('status', '<>', config('enum.category.status.delete'))
            ->field(['pid', 'count(*) AS count'])
            ->group('pid')
            ->select();
    }
}
