<?php
/**
 * 阿里云配置
 * Created By 皮神
 * Date: 2020/11/24
 */
return [
    'sms' => [
        'host' => env('sms.host'),
        'access_key_id' => env('sms.access_key_id'),
        'access_key_secret' => env('sms.access_key_secret'),
        'region_id' => env('sms.region_id'),
        'template_code' => env('sms.template_code'),
        'sign_name' => env('sms.sign_name')
    ]
];
