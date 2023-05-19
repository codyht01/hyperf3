<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/5/19
 * Time: 14:43
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Chat;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\Utils\Coroutine;
use Hyperf\Utils\Parallel;
use Swoole\Coroutine\Http\Client;

class ChatController extends ChatBaseController
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
                $api_key = env('CHAT_GPT_API', '');
                $client = new Client('api.openai.com', 443, true);
                $client->set([
                    'timeout' => 5,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $api_key, // 替换为你的 API 密钥
                    ],
                ]);
                $client->post('/v1/chat/completions', json_encode($request));
                $response = $client->body;
                $client->close();

                return $response;
            });
        }

        $responses = $parallel->wait();
        var_dump($responses);
        // 处理响应
        $answer = $this->parseChatResponse($responses[0]);
        var_dump($answer);
        return $answer;
    }

    /**
     * 创建请求
     * @param $data
     * @return array
     */
    private function createChatRequest($data)
    {
        $api_key = env('CHAT_GPT_API', '');
        return [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $api_key, // 替换为你的 API 密钥
            ],
            'body' => json_encode($data),
        ];
    }

    /**
     * 解析 Chat 响应
     * @param $response
     * @return mixed
     */
    private function parseChatResponse($response)
    {
        $responseData = json_decode($response, true);
        $answer = $responseData['choices'][0]['message']['content'];
        return $answer;
    }
}