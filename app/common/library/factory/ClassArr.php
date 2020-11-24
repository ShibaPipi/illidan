<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\library\factory;

use ReflectionClass;

abstract class ClassArr
{
    /**
     * 定义工厂内部类的别名
     * @return array
     */
    abstract public static function aliases(): array;

    /**
     * 根据传入的方法是否为静态返回不同值
     * @param string $type
     * @param array $classes
     * @param bool $needInstance
     * @param array $params
     * @return bool|mixed|object
     * @throws \ReflectionException
     */
    public static function initClass(string $type, bool $needInstance = false, array $params = [])
    {
        if (!array_key_exists($type, static::aliases())) {
            return false;
        }

        $class = static::aliases()[$type];

        return true === $needInstance
            ? (new ReflectionClass($class))->newInstanceArgs($params)
            : $class;
    }
}
