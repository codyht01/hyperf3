<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/7
 * Time: 16:10
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Lib\reflection\upload;

use App\Common\Lib\Random;
use App\Common\Lib\RequestIp;
use App\Exception\FooException;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\ApplicationContext;
use League\Flysystem\Filesystem;

class UploadBase
{
    /**
     * @var RequestInterface
     */
    #[Inject]
    protected RequestInterface $request;
    /**
     * @var FilesystemFactory
     */
    #[Inject]
    protected FilesystemFactory $factory;
    #[Inject]
    protected Filesystem $filesystem;

    /**
     * @return string[]
     * @throws \League\Flysystem\FilesystemException
     */
    public function upload(): array
    {
        $file = $this->request->file('file');
        $ext = $file->getClientMediaType();
        $size = $file->getSize();
        //验证后缀
        $this->getExtAttr($ext);
        $file_ext = $file->getExtension();
        //验证大小
        $this->getSizeAttr($size);
        $md5 = md5(Random::RandomStr());
        $fileName = $this->type . DIRECTORY_SEPARATOR . $md5 . "." . $file_ext;
        //上传
        $stream = fopen($file->getRealPath(), 'r+');
        $this->filesystem->writeStream($fileName, $stream);
        fclose($stream);
        //$ip = ApplicationContext::getContainer()->get(RequestIp::class)->__ip();
        //查询是否有存在数据
        //添加数据库
        return [
            "url" => "/public/" . $fileName,
            "alt" => "",
            "href" => ""
        ];
    }

    /**
     * @param string $ext
     * @return void
     */
    protected function getExtAttr(string $ext = '')
    {
        if (!in_array($ext, $this->ext)) {
            throw new FooException("当前类型不支持");
        }
    }

    /**
     * @param int $size
     * @return void
     */
    protected function getSizeAttr(int $size = 0)
    {
        if ($size <= 0) {
            throw new FooException("文件大小异常");
        }
        $file_size = $size / 1024;
        if ($file_size > $this->size * 1024) {
            throw new FooException("文件最大不能超过{$this->size}M");
        }
    }

    public function uploadTmp()
    {
        $file = $this->request->file('file');
        $all = $this->request->all();
        $fileSign = $this->request->input('fileSign', '');
        $chunkNumber = $this->request->input('chunkNumber', 0); //当前切片
        $totalChunks = $this->request->input('totalChunks', 0);  //总切片
        $totalChunkSize = $this->request->input('totalChunkSize', 0); //总切片大小
        $type = $file->getMimeType();
        //$this->getExtAttr($type);
        try {
            $stream = fopen($file->getRealPath(), 'r+');
            $this->filesystem->writeStream("tmp/" . $fileSign . "_" . $chunkNumber, $stream);
            fclose($stream);
        } catch (\Exception $e) {
            throw new FooException("上传失败");
        }
        return true;
    }
}