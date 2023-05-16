<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/4/10
 * Time: 11:09
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Websocket;

use App\Common\Lib\Show;
use App\Constants\SocketCode;
use Hyperf\Context\ApplicationContext;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Redis;
use Hyperf\WebSocketServer\Constant\Opcode;
use Hyperf\WebSocketServer\Context;
use Qbhy\HyperfAuth\AuthManager;

class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    /**
     * @var AuthManager
     */
    #[Inject]
    protected AuthManager $auth;

    /**
     * 关闭
     * @param $server
     * @param int $fd
     * @param int $reactorId
     * @return void
     */
    public function onClose($server, int $fd, int $reactorId): void
    {
        var_dump(Context::get('clientId'));
        var_dump('closed');
    }

    /**
     * 收到的消息
     * @param $server
     * @param $frame
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \RedisException
     */
    public function onMessage($server, $frame): void
    {
        if ($frame->opcode == Opcode::PING) {
            // 如果使用协程 Server，在判断是 PING 帧后，需要手动处理，返回 PONG 帧。
            // 异步风格 Server，可以直接通过 Swoole 配置处理，详情请见 https://wiki.swoole.com/#/websocket_server?id=open_websocket_ping_frame
            $server->push('', Opcode::PONG);
            return;
        }
        $data = $frame->data;
        var_dump($data);
        if (empty($data)) {
            return;
        }
        $arr_data = Show::json_decode($data);
        if (empty($arr_data)) {
            return;
        }
        $fd = $frame->fd;
        $container = ApplicationContext::getContainer();
        $msg = "";
        if ($arr_data['type'] == 'chat_message') {
            if (empty($arr_data['token'])) {
                return;
            }
            $user_id = $this->auth->guard('jwt')->id($arr_data['token']);
            if (!$user_id) {
                $msg = $this->send_show(SocketCode::NOTLogin, '您还未登录');
            } else {
                $container->get(Redis::class)->hSet("SocketUserId", $user_id, $fd);
                $msg = $this->send_show(SocketCode::SUCCESS, 'ok', [
                    "type" => 'chat_message',
                    "list" => [1, 2, 3]
                ]);
            }
        } else if ($arr_data['type'] == 'message') {

        }
        $server->push($frame->fd, $msg);
    }

    /**
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return bool|string
     */
    public function send_show(int $code = 0, string $msg = '', array $data = []): bool|string
    {
        $data = [
            'type' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return Show::json_encode($data);
    }

    /**
     * 打开
     * @param $server
     * @param $request
     * @return void
     */
    public function onOpen($server, $request): void
    {
        $fd = $request->fd;
        // 生成一个唯一的UUID
        $uuid = uniqid();
        // 将UUID和fd组合成一个唯一标识符
        $clientId = "client:$uuid:$fd";
        // 将客户端ID存储到上下文中
        Context::set('clientId', $clientId);
        $server->push($request->fd, $this->send_show(SocketCode::SUCCESS, 'ok'));
    }
}