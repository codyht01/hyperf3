<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/13
 * Time: 11:50
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);
 
 return [
     "accessKeyId"=>env('ali_access_key_id',''),
     "accessKeySecret"=>env('ali_access_key_secret',''),
     "signName" => env('ali_sign_name',''),  //签名
     "templateCode" => env('ali_template_code',''), //模板
 ];