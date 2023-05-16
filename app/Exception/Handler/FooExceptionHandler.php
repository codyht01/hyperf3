<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/7
 * Time: 15:28
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Exception\Handler;

use App\Common\Lib\Log\Log;
use App\Common\Lib\Show;
use App\Exception\FooException;
use Hyperf\Di\Exception\NotFoundException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\ExceptionHandler\ExceptionHandlerDispatcher;
use Hyperf\ExceptionHandler\Listener\ErrorExceptionHandler;
use Hyperf\HttpMessage\Exception\HttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Qbhy\HyperfAuth\Exception\AuthException;
use Throwable;

class FooExceptionHandler extends ExceptionHandler
{
    /**
     * @param Throwable $throwable
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handle(Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $data = [
            'code' => 500,
            'msg' => "内部异常",
        ];
        var_dump($throwable->getMessage());
        // 判断被捕获到的异常是希望被捕获的异常
        if ($throwable instanceof FooException) {
            // 格式化输出
            $data = [
                'code' => $throwable->getCode(),
                'msg' => $throwable->getMessage(),
            ];
        }
        //捕获HTTP异常
        if ($throwable instanceof HttpException) {
            $data = [
                'code' => $throwable->getCode(),
                'msg' => "请求错误",
            ];
        }
        if (!empty($data)) {
            Log::get('exception-error', 'error')->error($throwable->getMessage() . " " . $throwable->getFile() . " " . $throwable->getCode());
            $this->stopPropagation();
            return $response->withStatus(500)->withBody(new SwooleStream(Show::json_encode($data)));
        }

        // 交给下一个异常处理器
        return $response;

        // 或者不做处理直接屏蔽异常
    }

    /**
     * 判断该异常处理器是否要对该异常进行处理
     */
    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}