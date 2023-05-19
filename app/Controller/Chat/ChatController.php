<?php
declare(strict_types=1);

namespace App\Controller\Chat;

use Hyperf\Coroutine\Parallel;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\PostMapping;

use Swoole\Coroutine\Http\Client;

class ChatController
{
    public function chat()
    {
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => 'Who won the world series in 2020?'],
                ['role' => 'assistant', 'content' => 'The Los Angeles Dodgers won the World Series in 2020.'],
                ['role' => 'user', 'content' => 'Where was it played?'],
            ],
        ];

        $requests = [
            $this->createChatRequest($data),
        ];

        $parallel = new Parallel();
        foreach ($requests as $request) {
            $parallel->add(function () use ($request) {
                $client = new Client('api.openai.com', 443, true);
                $send = [
                    'timeout' => 5,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . env('CHAT_GPT_API'), // 替换为你的 API 密钥
                    ],
                ];
                var_dump($send);
                $client->set($send);
                $client->post('/v1/chat/completions', json_encode($request));
                $response = $client->body;
                var_dump($response);
                $client->close();

                return $response;
            });
        }

        $responses = $parallel->wait();

        // 处理响应
        $answer = $this->parseChatResponse($responses[0]);
        return $answer;
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
