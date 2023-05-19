<?php
declare(strict_types=1);

namespace App\Controller\Chat;

use Swoole\Coroutine\Http2\Client;

class ChatController
{
    public function chat()
    {
        \Hyperf\Coroutine\go(function () {
            $client = new \Swoole\Coroutine\Http\Client('api.openai.com', 443, true);
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('CHAT_GPT_API'),
            ];
            $client->setHeaders($headers);

            $client->post('/v1/chat/completions', '{"model":"gpt-3.5-turbo","messages":[{"role":"assistant","content":"请问如何煮鸡蛋"}]}');
            // 协程挂起等待异步结果
            while (true) {
                $response = $client->recv();
                if ($response === false || $response->statusCode === -1) {
                    break;
                }
                var_dump($response);
                if ($response->statusCode === 200) {
                    echo $response->body;
                } else {
                    echo '请求失败，状态码：' . $response->statusCode;
                }
            }
            $client->close();
        });
    }

    /**
     * 创建 Chat 请求
     */
    private function createChatRequest($data)
    {
        return [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('CHAT_GPT_API'), // 替换为你的 API 密钥
            ],
            'body' => json_encode($data),
        ];
    }

    /**
     * 解析 Chat 响应
     */
    private function parseChatResponse($response)
    {
        $responseData = json_decode($response, true);
        $answer = $responseData['choices'][0]['message']['content'];
        return $answer;
    }
}
