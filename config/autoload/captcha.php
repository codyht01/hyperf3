<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/1/30
 * Time: 10:04
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

return [
    //验证码位数
    'length' => 5,
    // 验证码字符集合
    'codeSet' => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
    // 验证码过期时间
    'expire' => 1800,
    // 是否使用中文验证码
    'useZh' => false,
    // 是否使用算术验证码
    'math' => false,
    // 是否使用背景图
    'useImgBg' => false,
    //验证码字符大小
    'fontSize' => 25,
    // 是否使用混淆曲线
    'useCurve' => true,
    //是否添加杂点
    'useNoise' => true,
    // 验证码字体 不设置则随机
    'fontttf' => '',
    //背景颜色
    'bg' => [243, 251, 254],
    // 验证码图片高度
    'imageH' => 2,
    // 验证码图片宽度
    'imageW' => 2,

    // 添加额外的验证码设置
    "login" => [
        "codeSet" => '0123456789',
        "length" => 4
    ]
];