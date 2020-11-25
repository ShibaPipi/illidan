<?php
// 应用公共文件
declare(strict_types=1);

use think\response\Json;

if (!function_exists('api_response')) {
    /**
     * 通用化 API 格式输出
     * @param int $code
     * @param string $message
     * @param array $data
     * @param int $httpStatus
     * @return Json
     */
    function api_response(int $code, string $message = 'error', array $data = null, int $httpStatus = 200): Json
    {
        return json(compact('code', 'message', 'data'), $httpStatus);
    }
}

if (!function_exists('api_success')) {
    /**
     * 通用化 API 成功格式输出
     * @param string $message
     * @param int $httpStatus
     * @param array $data
     * @return Json
     */
    function api_success(string $message = 'success', array $data = [], int $httpStatus = 200): Json
    {
        return api_response(config('code.success'), $message, $data, $httpStatus);
    }
}
