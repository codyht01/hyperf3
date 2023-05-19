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


use GuzzleHttp\Client;
use Hyperf\Coroutine\Parallel;
use Hyperf\Coroutine\Coroutine;
use Hyperf\Coroutine\Exception\ParallelExecutionException;
use Hyperf\Guzzle\ClientFactory;
use GuzzleHttp\Promise\Utils;
use Psr\Http\Message\ResponseInterface;


class ChatController extends ChatBaseController
{
    private $clientFactory;

    public function __construct(ClientFactory $clientFactory)
    {
        $this->clientFactory = $clientFactory;
    }

    public function chat()
    {
        $parallel = new Parallel();
        $parallel->add(function () {
            $client = new Client();
            $data = [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => 'Who won the world series in 2020?'],
                    ['role' => 'assistant', 'content' => 'The Los Angeles Dodgers won the World Series in 2020.'],
                    ['role' => 'user', 'content' => 'Where was it played?'],
                ],
            ];
            $promise = $client->postAsync('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('CHAT_GPT_API'),
                ],
                'json' => $data,
            ]);
            $promise->then(function (ResponseInterface $response) {
                $result = $response->getBody()->getContents();

                // 处理响应
                $responseData = json_decode($result, true);
                $answer = $responseData['choices'][0]['message']['content'];

                // 在协程中回应请求
                Coroutine::create(function () use ($answer) {
                    // 返回响应
                    return $answer;
                });
            });
            return Coroutine::id();
        });
        try {
            // $results 结果为 [1, 2]
            $results = $parallel->wait();
        } catch (ParallelExecutionException $e) {
            // $e->getResults() 获取协程中的返回值。
            // $e->getThrowables() 获取协程中出现的异常。
        }
        var_dump($results);
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