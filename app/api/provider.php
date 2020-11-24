<?php
// 容器Provider定义文件

use app\common\exception\ExceptionHandler;

return [
    'think\exception\Handle' => ExceptionHandler::class,
];
