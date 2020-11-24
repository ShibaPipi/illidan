<?php
/**
 * 自定义验证基类
 * User: sun.yaopeng
 * Date: 2020/11/23
 */
declare(strict_types=1);

namespace app\common\exception;

use think\Exception;

class BaseException extends Exception
{
    public $code = 400;

    public $msg = '通用参数错误';

    public $errorCode = 10000;

    public function __construct(array $params = [])
    {
        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }

        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }

        if (array_key_exists('errorCode', $params)) {
            $this->errorCode = $params['errorCode'];
        }

        parent::__construct();
    }
}
