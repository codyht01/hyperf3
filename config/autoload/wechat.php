<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/4/19
 * Time: 16:34
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);

return [
    'mini_program' => [
        'default' => [
            'app_id' => env('WECHAT_MINI_PROGRAM_APPID', ''),
            'secret' => env('WECHAT_MINI_PROGRAM_SECRET', ''),

            // 下面为可选项
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            'log' => [
                'level' => 'debug',
                'file' => __DIR__ . '/wechat.log',
            ],
        ]
    ],
    'payment' => [],
    'official_account' => []
];
 
 