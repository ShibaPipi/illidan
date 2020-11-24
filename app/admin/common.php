<?php
/**
 * 应用公共文件
 * User: sun.yaopeng
 * Date: 2020/11/23
 */

if (!function_exists('admin_session')) {
    /**
     * admin 应用 session 封装
     * @param string|null $value
     * @return mixed
     */
    function admin_session($value = '')
    {
        return session(config('illidan.admin.session_name'), $value);
    }
}
