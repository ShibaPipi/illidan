<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/30
 */

namespace app\common\library;

class Arr
{
    /**
     * 获取树状结构数据
     * @param array $data
     * @return array
     */
    public static function arborescent(array $data): array
    {
        $arr = [];
        foreach ($data as $v) {
            $arr[$v['id']] = $v;
        }
        $arborescence = [];
        foreach ($arr as $id => $item) {
            if (isset($arr[$item['pid']])) {
                $arr[$item['pid']]['children'][] = &$arr[$id];
            } else {
                $arborescence[] = &$arr[$id];
            }
        }
        return $arborescence;
    }
}
