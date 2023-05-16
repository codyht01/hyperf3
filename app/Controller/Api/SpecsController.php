<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/24
 * Time: 15:59
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Business\SpecsBusiness;
use App\Common\Lib\Show;
use App\Constants\ErrorCode;
use App\Request\SpecsRequest;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;

class SpecsController extends ApiBaseController
{
    protected SpecsBusiness $obj_bus;

    public function __construct()
    {
        $this->obj_bus = new SpecsBusiness();
    }

    /**
     * @param SpecsRequest $request
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function add(SpecsRequest $request): \Psr\Http\Message\ResponseInterface
    {
        $insert_data = [
            "id" => $this->request->input('id', 0),
            "title" => $this->request->input('title', ''),
            "sort" => $this->request->input('sort', 0)
        ];
        try {
            $this->obj_bus->add($insert_data);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok');
    }

    /**
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getSpecsByListInfo(): ResponseInterface
    {
        try {
            $result = $this->obj_bus->getBaseByListInfo([
                ['status', '=', ErrorCode::MYSQL_SUCCESS]
            ], 'sort,id');
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }
}