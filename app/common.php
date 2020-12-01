<?php
// 应用公共文件
declare(strict_types=1);

use think\response\Json;

if (!function_exists('api_response')) {
    /**
     * 通用化 API 格式输出
     * @param int $code
     * @param string $message
     * @param array|null $data
     * @param int $httpStatus
     * @return Json
     */
    function api_response(int $code, string $message = 'error', ?array $data = null, int $httpStatus = 200): Json
    {
        return json(compact('code', 'message', 'data'), $httpStatus);
    }
}

if (!function_exists('api_success')) {
    /**
     * 通用化 API 成功格式输出
     * @param string $message
     * @param array|null $data
     * @param int $httpStatus
     * @return Json
     */
    function api_success(string $message = 'success', ?array $data = null, int $httpStatus = 200): Json
    {
        return api_response(config('code.success'), $message, $data, $httpStatus);
    }
}

if (!function_exists('api_created_or_updated')) {
    /**
     * 新增或更新成功，通用化 API 格式输出
     * @param string $message
     * @param array|null $data
     * @param int $httpStatus
     * @return Json
     */
    function api_created_or_updated(string $message = '操作成功', ?array $data = null, int $httpStatus = 201): Json
    {
        return api_success($message, $data, $httpStatus);
    }
}
