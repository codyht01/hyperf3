<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/7
 * Time: 15:34
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Lib;

use App\Constants\ErrorCode;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;

class Show
{
    /**
     * 失败
     * @param string $msg
     * @param int $code
     * @param int $httpCode
     * @return Psr7ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function error(string $msg = "", int $code = ErrorCode::STATUS_ERROR, int $httpCode = 200): Psr7ResponseInterface
    {
        return self::json_show($code, $msg, [], $httpCode);
    }

    /**
     * @param int $code
     * @param string $msg
     * @param array $data
     * @param int $httpCode
     * @return Psr7ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private static function json_show(int $code = 0, string $msg = '', array $data = [], int $httpCode = 200): Psr7ResponseInterface
    {
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return self::response(json_encode($result, JSON_UNESCAPED_UNICODE), $httpCode);
    }

    /**
     * 统一响应数据
     * @param string $data
     * @param int $httpCode
     * @return Psr7ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private static function response(string $data = '', int $httpCode = 200): Psr7ResponseInterface
    {
        $response = self::container()->get(ResponseInterface::class);
        return $response->withAddedHeader('content-type', 'application/json; charset=utf-8')->withStatus($httpCode)->withBody(new SwooleStream($data));
    }

    /**
     * 容器实例
     * @return \Psr\Container\ContainerInterface
     */
    private static function container(): \Psr\Container\ContainerInterface
    {
        return ApplicationContext::getContainer();
    }

    /**
     * 成功
     * @param string $msg
     * @param array $data
     * @param int $code
     * @param int $httpCode
     * @return Psr7ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function success(string $msg = "", array $data = [], int $code = ErrorCode::STATUS_SUCCESS, int $httpCode = 200): Psr7ResponseInterface
    {
        return self::json_show($code, $msg, $data, $httpCode);
    }

    /**
     * @param array $data
     * @return false|string
     */
    public static function json_encode(array $data = []): bool|string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string $data
     * @return mixed
     */
    public static function json_decode(string $data = ''): mixed
    {
        return json_decode($data, true);
    }
}