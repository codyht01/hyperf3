<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/13
 * Time: 11:36
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Lib\reflection\sms;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Utils\Utils;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use App\Exception\FooException;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use Hyperf\Cache\Cache;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;

class Ali extends SmsBase
{
    protected $config;

    /**
     * 发送验证码
     * @param string $mobile
     * @param string $code
     * @return bool
     */
    public function send_code(string $mobile = "", string $code = ""): bool
    {
        $this->config = config('ali_code', []);
        $client = $this->createClient($this->config['accessKeyId'], $this->config['accessKeySecret']);
        $sendSmsRequest = new SendSmsRequest([
            "phoneNumbers" => $mobile,
            "signName" => $this->config['signName'],
            "templateCode" => $this->config['templateCode'],
            "templateParam" => json_encode([
                "code" => $code
            ])
        ]);
        $runtime = new RuntimeOptions([]);
        try {
            // 复制代码运行请自行打印 API 的返回值
            $result = $client->sendSmsWithOptions($sendSmsRequest, $runtime);
            $res = $result->body;
        } catch (\Exception $error) {
            if (!($error instanceof TeaError)) {
                $error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
            }
            throw new FooException($error->getMessage());
        }
        switch ($res) {
            case "OK":
                $key = "sms_code" . $mobile;
                $client = ApplicationContext::getContainer()->get(Cache::class);
                $client->set($key, $code, 60);
                return true;
                break;
            case "isv.BUSINESS_LIMIT_CONTROL":
                throw new FooException("超过发送频率");
                break;
            default :
                throw new FooException("发送失败");
                break;
        }
    }

    /**
     * 初始化
     * @param $accessKeyId
     * @param $accessKeySecret
     * @return Dysmsapi
     */
    public function createClient($accessKeyId, $accessKeySecret)
    {
        $config = new Config([
            // 必填，您的 AccessKey ID
            "accessKeyId" => $accessKeyId,
            // 必填，您的 AccessKey Secret
            "accessKeySecret" => $accessKeySecret
        ]);
        // 访问的域名
        $config->endpoint = "dysmsapi.aliyuncs.com";
        return new Dysmsapi($config);
    }
}