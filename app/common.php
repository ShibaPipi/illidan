<?php
// 应用公共文件

if (!function_exists('api_response')) {
    /**
     * 通用化 API 格式输出
     * @param int $code
     * @param string $message
     * @param array $data
     * @param int $httpStatus
     * @return \think\response\Json
     */
    function api_response(int $code, string $message = 'error', array $data = null, int $httpStatus = 200)
    {
        return json(compact('code', 'message', 'data'), $httpStatus);
    }
}
