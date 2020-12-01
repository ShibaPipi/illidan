<?php
/**
 * 项目通用配置
 * Created By 皮神
 * Date: 2020/11/21
 */
return [
    'admin' => [
        'session_name' => 'admin_user'
    ],
    'api' => [
        'sms_code' => [
            'prefix' => 'sms_code_pre_',
            'expire' => 60 * 2,
        ],
        'token_prefix' => 'token_pre_'
    ]
];
