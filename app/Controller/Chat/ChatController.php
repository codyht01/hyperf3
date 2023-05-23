<?php
declare(strict_types=1);

namespace App\Controller\Chat;

use Hyperf\Coroutine\Coroutine;
use Hyperf\Coroutine\Exception\ParallelExecutionException;
use Hyperf\Coroutine\Parallel;
use Swoole\Coroutine\Channel;
use Swoole\Coroutine\Http2\Client;

class ChatController
{
    public function chat()
    {

        $channel = new Channel();
        $client = new \GuzzleHttp\Client();
        $api_key = env('CHAT_GPT_API');
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'assistant', 'content' => '我想煮100个鸡蛋，最详情的步骤'],
            ],
        ];
        Coroutine::create(function () use ($client, $api_key, $data, $channel) {
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $api_key,
                ],
                'json' => $data,
            ]);
            $result = $response->getBody()->getContents();
            $channel->push($result);
        });
        // 逐步返回结果
        while (true) {
            if ($channel->isEmpty()) {
                // 协程休眠一段时间，避免 CPU 占用过高
                Coroutine::sleep(0.1);
                continue;
            }

            // 从通道中读取结果
            $result = $channel->pop();

            // 处理响应
            $responseData = json_decode($result, true);
            $answer = $responseData['choices'][0]['message']['content'];

            // 返回响应
            return $answer;
        }
//        $parallel = new Parallel();
//        $parallel->add(function () {
//            $client = new \Swoole\Coroutine\Http\Client('api.openai.com', 443, true);
//            $headers = [
//                'Content-Type' => 'application/json',
//                'Authorization' => 'Bearer ' . env('CHAT_GPT_API'),
//            ];
//            $client->setHeaders($headers);
//            $data = [
//                'model' => 'gpt-3.5-turbo',
//                'messages' => [
//                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
//                    ['role' => 'user', 'content' => 'Who won the world series in 2020?'],
//                    ['role' => 'assistant', 'content' => 'The Los Angeles Dodgers won the World Series in 2020.'],
//                    ['role' => 'user', 'content' => 'Where was it played?'],
//                ],
//            ];
//            $client->post('/v1/chat/completions', json_encode($data));
//            $response = $client->body;
//            $client->close();
//            return $response;
//        });
//
//        try {
//            // $results 结果为 [1, 2]
//            $responses = $parallel->wait();
//            var_dump($responses);
//            // 处理响应
//            $answer = $this->parseChatResponse($responses[0]);
//        } catch (ParallelExecutionException $e) {
//            // $e->getResults() 获取协程中的返回值。
//            // $e->getThrowables() 获取协程中出现的异常。
//        }
//
//        return $answer;

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
}
