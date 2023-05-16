<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/4/25
 * Time: 8:42
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Lib\Show;

class TestController extends ApiBaseController
{
    public function index(): \Psr\Http\Message\ResponseInterface
    {
        $data = $this->request->all();
        var_dump($data);
        return Show::success('ok');
    }

    public function ss()
    {
        var_dump($this->request->all());
    }

    public function application_info()
    {
        $json = '{
            "action":"query_db",
            "data":{
                "handle":"f186ae0",
                "sql":"select id,name,english_name,email,birthday,mobile,phone,number,level,authority,display_order,account,gender,avator_url,corp_id,internation_code,name_status,create_mail,real_name,verifying_name,position,has_bind_email,office_phone,workcardimage_url,has_updated_work_card_image,address,circle_name,unionid,external_corp_name,external_job,info_level,user_vcode,hex(pb_content) as content from user_table where mobile = \"15683273403\""
            }
        }';
        $arr = Show::json_decode($json);
        $result = $this->__post('http://192.168.0.9/apis', Show::json_encode($arr));

        if (!empty($result)) {
            $json_arr = Show::json_decode($result);
            var_dump($json_arr);
            $lists = [];
            foreach ($json_arr as $k => $v) {
                $lists[$k] = $v;
                $lists[$k]['content'] = $this->__hex2txt($v['content']);
            }
        }
        var_dump($lists);
    }

    /**
     * @param string $url
     * @param string $data
     * @return bool|string
     */
    protected function __post(string $url = '', string $data = "")
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    protected function __hex2txt($hex)
    {
        $str = '';
        $arr = str_split($hex, 2);
        foreach ($arr as $bit) {
            $str .= chr(hexdec($bit));
        }
        return $str;
    }

    public function test()
    {
        $json = '{
            "action":"query_db",
            "data":{
                "handle":"232aaef0",
                "sql":"select message_id,server_id,sequence,sender_id,conversation_id,content_type,send_time,flag,devinfo,from_app_id,msg_from_devinfo,client_id,local_extra_content_translate_info,local_extra_content_time_nlp,local_extra_content_approval_nlp,hex(content) as content from message_table order by sequence desc limit 5 "
            }
        }';
        $arr = Show::json_decode($json);
        $result = $this->__post('http://192.168.0.9/apis', Show::json_encode($arr));

        if (!empty($result)) {
            $json_arr = Show::json_decode($result);
            $lists = [];
            try {
                foreach ($json_arr as $k => $v) {
                    $lists[$k] = $v;
                    $content = substr_replace($v['content'], '', 0, 16);
                    if ($v['content_type'] == 2) { //文本消息
                        $lists[$k]['content'] = mb_convert_encoding($this->__hex2txt($content), 'utf-8');
                    } else if ($v['content_type'] == 29) { //表情
                        $lists[$k]['content'] = $this->__hex2txt($content);
                        $content_url = explode(" ", $lists[$k]['content']);
                        $lists[$k]['content'] = rtrim($this->__wpjam_strip_control_characters($content_url[0]), '2');
                    } else if ($v['content_type'] == 38) {  //卡片信息
                        $lists[$k]['content'] = $this->__content_str(mb_convert_encoding($this->__hex2txt($content), 'utf-8'));
                    } else if ($v['content_type'] == 101) { //图片
                        $lists[$k]['content'] = $v['content'];
                    } else if ($v['content_type'] == 13) {  //图文消息
                        $lists[$k]['content'] = "图文消息";
                    } else if ($v['content_type'] == 26) { //红包消息
                        $lists[$k]['content'] = "红包消息";
//                        $lists[$k]['content'] = $this->__hex2txt($content);
                    } else if ($v['content_type'] == 6) { // 位置信息
                        //$content = $v['content'];
                        $lists[$k]['content'] = "位置信息";
                    } else if ($v['content_type'] == 40) {//通话时间
                        $content = substr_replace($v['content'], '', 0, 12);
                        $lists[$k]['content'] = $this->__hex2txt($content);
                        $content_url = explode(" ", $lists[$k]['content']);
                        $lists[$k]['content'] = $content_url[0];
                    } else if ($v['content_type'] == 503) { //视频通话
                        $content = "视频发起消息";
                        $lists[$k]['content'] = $content;
                    } else if ($v['content_type'] == 1011) {
                        $content = substr_replace($v['content'], '', 0, 0);
                        $lists[$k]['content'] = $this->__hex2txt($content);
                    } else if ($v['content_type'] == 1006) {
                        $content = substr_replace($v['content'], '', 0, 0);
                        $lists[$k]['content'] = $this->__hex2txt($content);
                    } else {
                        $lists[$k]['content'] = $content;
                    }
                }
            } catch (\Exception $e) {
                return Show::error($e->getMessage());
            }
            var_dump($lists);
            return Show::success('ok', $lists);
        } else {
            return Show::error('返回为空');
        }

    }

    protected function __wpjam_strip_control_characters($str)
    {
        return preg_replace('/[\x00-\x1F\x7F-\x9F-\x12]/', '', $str);
    }

    /**
     * @param $str
     * @return array|string|string[]
     */
    protected function __content_str($str)
    {
        return str_replace(array("\x01", "\x12", "\x1A"), "", $str);
    }
}