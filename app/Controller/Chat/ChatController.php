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


use Hyperf\Coroutine\Parallel;
use Hyperf\Coroutine\Coroutine;
use Hyperf\Coroutine\Exception\ParallelExecutionException;
use Swoole\Coroutine\Http\Client;


class ChatController extends ChatBaseController
{
    public function chat()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer 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',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => 'Who won the world series in 2020?'],
                ['role' => 'assistant', 'content' => 'The Los Angeles Dodgers won the World Series in 2020.'],
                ['role' => 'user', 'content' => 'Where was it played?'],
            ],
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// 设置回调函数处理异步响应
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($ch, $headerLine) use (&$headers) {
            $headers[] = $headerLine;
            return strlen($headerLine);
        });

        $mh = curl_multi_init();
        curl_multi_add_handle($mh, $ch);

// 执行异步请求
        do {
            $status = curl_multi_exec($mh, $active);
        } while ($status === CURLM_CALL_MULTI_PERFORM || $active);

// 处理异步响应
        $response = curl_multi_getcontent($ch);
        $info = curl_getinfo($ch);

        curl_multi_remove_handle($mh, $ch);
        curl_multi_close($mh);
        curl_close($ch);

// 处理响应
        $responseData = json_decode($response, true);
        $answer = $responseData['choices'][0]['message']['content'];

        echo $answer;
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