<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/21
 * Time: 10:07
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Common\Lib\Log\Log;
use App\Constants\ErrorCode;
use App\Exception\FooException;
use App\Model\UploaderCate;

class UploaderCateBusiness extends BusBase
{
    /**
     * @var UploaderCate|\Hyperf\Database\Model\Builder
     */
    protected $obj_model;

    public function __construct()
    {
        $this->obj_model = new UploaderCate();
    }

    /**
     * @param array $data
     * @return true
     */
    public function add(array $data = []): bool
    {
        if (empty($data)) {
            throw new FooException("内部异常");
        }
        try {
            $result = $this->obj_model->where('title', $data['title'])->first();
        } catch (\Exception $e) {
            throw new FooException("异常错误");
        }
        if ($result) {
            throw new FooException("该分类已经存在");
        }
        try {
            $data['create_time'] = time();
            $data['update_time'] = time();
            $data['status'] = ErrorCode::MYSQL_SUCCESS;
            $res = $this->obj_model->insert($data);
        } catch (\Exception $e) {
            Log::get("uploadCate-add", "error")->error($e->getMessage());
            throw new FooException("添加失败！请稍后重试" . $e->getMessage());
        }
        if (!$res) {
            throw new FooException("添加失败");
        }
        return true;
    }

    /**
     * @param string $title
     * @param bool $is_normal
     * @return void
     */
    public function getUploaderCateByTitle(string $title = '', bool $is_normal = false)
    {
        if (empty($title)) {
            throw new FooException("请输入标题");
        }
        $where = [];
        $where[] = [
            ['title', '=', $title]
        ];
        if ($is_normal) {
            $where[] = [
                ['status', '=', ErrorCode::MYSQL_SUCCESS]
            ];
        }
        try {
            $this->obj_model->where($where)->first();
        } catch (\Exception $e) {
            throw new FooException("异常错误");
        }
    }
}