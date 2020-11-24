<?php
declare (strict_types=1);

namespace app\demo\controller;

class Error
{
    /**
     * 根据请求来源（API 或者 H5），返回对应的错误信息
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        return api_response(config('code.controller_not_found'), "找不到控制器", null, 400);
    }
}
