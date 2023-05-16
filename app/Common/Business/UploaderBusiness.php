<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/7
 * Time: 20:01
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);

namespace App\Common\Business;

use App\Common\Lib\Log\Log;
use App\Common\Lib\RequestIp;
use App\Constants\ErrorCode;
use App\Exception\FooException;
use App\Model\Uploader;
use Hyperf\Utils\ApplicationContext;
use PHPUnit\Exception;

class UploaderBusiness extends BusBase
{
    protected $obj_model;

    public function __construct()
    {
        $this->obj_model = new Uploader();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function addUploaderData(array $data = [])
    {
        //根据md5查询是否存在 存在则不操作 不存在则创建+
        try {
            $row = $this->obj_model->where('md5', $data['md5'])
                ->first();
        } catch (Exception $e) {
            Log::get('uploaderBusiness-get', 'error')->error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
            throw new FooException("查询失败");
        }
        if ($row) {
            return true;
        } else {
            $data['create_time'] = time();
            $data['update_time'] = time();
            try {
                $res = Uploader::query()->insert($data);
            } catch (\Exception $e) {
                Log::get('uploaderBusiness-insert', 'error')->error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
                throw new FooException("操作失败");
            }
            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @param string $fileMd5
     * @return bool
     */
    public function getUploadFile(string $fileMd5 = ''): bool
    {
        if (empty($fileMd5)) {
            throw new FooException("查询失败");
        }
        try {
            $result = $this->obj_model->where('md5', $fileMd5)->first();
        } catch (\Exception $e) {
            throw new FooException("内部异常");
        }
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param int $chunkCount
     * @param string $fileName
     * @param string $fileSign
     * @param string $type
     * @param int $cate_id
     * @return true
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function mergeData(int $chunkCount = 0, string $fileName = '', string $fileSign = '', string $type = "", int $cate_id = 0)
    {
        if ($chunkCount < 1 || empty($fileName) || empty($fileSign) || empty($type)) {
            throw new FooException("内部异常3");
        }
        $ext_type = explode('/', $type);
        if (empty($ext_type[1])) {
            throw new FooException("内部异常1");
        }
        $tempPath = BASE_PATH . "/public/tmp/";
        //判断数量是否正确
        $is_true = false;
        for ($i = 0; $i < $chunkCount; $i++) {
            $res = $tempPath . $fileSign . "_" . $i;
            if (!file_exists($res)) {
                $is_true = true;
                break;
            }
        }
        if ($is_true) {
            throw new FooException("内部异常2");
        }
        $save_name = $fileSign . "." . $ext_type[1];
        if (!is_dir(BASE_PATH . "/public/" . $ext_type[0])) {
            @mkdir(BASE_PATH . "/public/" . $ext_type[0]);
        }
        $saveDir = BASE_PATH . "/public/" . $ext_type[0] . DIRECTORY_SEPARATOR . date('Y-m-d');
        if (!is_dir($saveDir)) {
            @mkdir($saveDir);
        }
        $uploadDir = $saveDir . DIRECTORY_SEPARATOR . $save_name;
        //$timeStart = $this->getmicrotime(); //合并开始时间
        //合并文件
        $out = @fopen($uploadDir, "wb");
        if (!$out) {
            throw new FooException("文件不可写");
        }
        if (flock($out, LOCK_EX)) { // 进行排他型锁定
            for ($index = 0; $index < $chunkCount; $index++) {
                if (!$in = @fopen($tempPath . $fileSign . "_" . $index, "rb")) {
                    break;
                }
                while ($buff = fread($in, 4096)) {
                    fwrite($out, $buff);
                }
                @fclose($in);
                @unlink($tempPath . $fileSign . "_" . $index); //删除分片
            }
            flock($out, LOCK_UN); // 释放锁定
        }
        @fclose($out);
        $saveFileUrl = "/public/" . $ext_type[0] . DIRECTORY_SEPARATOR . date('Y-m-d') . DIRECTORY_SEPARATOR . $save_name;
        $insert_data = [
            "cate_id" => $cate_id,
            "url" => $saveFileUrl,
            "md5" => $fileSign,
            "fileName" => $fileName,
            "ext" => $ext_type[1],
            "upload_ip" => ip2long(ApplicationContext::getContainer()->get(RequestIp::class)->__ip()),
            "status" => ErrorCode::MYSQL_SUCCESS,
            "type" => $ext_type[0]
        ];
        try {
            $res = $this->obj_model->insert($insert_data);
        } catch (\Exception $e) {
            throw new FooException("操作失败" . $e->getMessage());
        }
        return true;
    }

}