<?php

// 容器Provider定义文件
use app\demo\exception\Http;

return [
    'think\exception\Handle' => Http::class,
];
