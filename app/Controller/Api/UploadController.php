<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/7
 * Time: 15:56
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Business\UploadBusiness;
use App\Common\Business\UploaderBusiness;
use App\Common\Lib\reflection\ArrClass;
use App\Common\Lib\Show;
use App\Controller\AbstractController;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\Utils\ApplicationContext;
use League\Flysystem\Filesystem;

class UploadController extends ApiBaseController
{
    protected $obj_bus = null;

    public function __construct()
    {
        $this->obj_bus = new UploaderBusiness();
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface|void
     * @throws \League\Flysystem\FilesystemException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function mergeData()
    {
        $chunkCount = $this->request->input('chunkCount', 0);
        $fileName = $this->request->input('fileName', '');
        $fileSign = $this->request->input('fileSign', '');
        $type = $this->request->input('type', '');
        $cate_id = $this->request->input('cate_id', '');
        try {
            $result = $this->obj_bus->mergeData(intval($chunkCount), $fileName, $fileSign, $type, $cate_id);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok');
    }

    /**
     * 上传文件
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function file()
    {
        $file = $this->request->file('file');  //上传文件
        if ($file === null) {
            return Show::error("请选择文件上传");
        }
        $md5 = $this->request->input('fileSign', '');  //文件的md5
        if (empty($md5)) {
            return Show::error("文件md5不能为空");
        }
        $fileType = $this->request->input('fileType', 'image');
        try {
            $arrClass = new ArrClass();
            $result = $arrClass->initClass($fileType, $arrClass->uploadAttr(), [], true)->uploadTmp();
//            $arrClass = ApplicationContext::getContainer()->get(ArrClass::class);
//            $result = $arrClass->initClass($type[0], $arrClass->uploadAttr(), [], true)->uploadTmp();
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index(): \Psr\Http\Message\ResponseInterface
    {
        $cate_id = $this->request->input('cate_id', 0);
        $limit = $this->request->input('limit', 10);
        $type = $this->request->input('type', '');
        $where = [];
        if (intval($cate_id) != 0) {
            $where[] = ['cate_id', '=', $cate_id];
        }
        if (!empty($type)) {
            $where[] = ['type', '=', $type];
        }
        try {
            $result = $this->obj_bus->index($limit, $where, ['*']);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getUploadFile()
    {
        $fileMd5 = $this->request->input('fileMd5', '');
        try {
            $result = $this->obj_bus->getUploadFile($fileMd5);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        $res = [];
        if ($result) {
            $res = [
                'is_true' => true
            ];
        } else {
            $res = [
                'is_true' => false
            ];
        }
        return Show::success('ok', $res);
    }

    public function image()
    {
        try {
            $arrClass = ApplicationContext::getContainer()->get(ArrClass::class);
            $result = $arrClass->initClass('image', $arrClass->uploadAttr(), [], true)->upload();
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }
}