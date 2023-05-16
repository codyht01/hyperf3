<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/29
 * Time: 14:45
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Business\GoodsBusiness;
use App\Common\Lib\Show;
use App\Request\GoodsRequest;

class GoodsController extends ApiBaseController
{
    protected ?GoodsBusiness $obj_bus = null;
    protected array $where = [];

    public function __construct()
    {
        $this->obj_bus = new GoodsBusiness();
    }

    /**
     * @param GoodsRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function add(GoodsRequest $request): \Psr\Http\Message\ResponseInterface
    {
        $data = $this->request->all();
        try {
            $result = $this->obj_bus->add($data);
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
    public function getInfo(): \Psr\Http\Message\ResponseInterface
    {
        $id = $this->request->input('id', 0);
        try {
            $result = $this->obj_bus->getInfo(intval($id));
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
    public function index(): \Psr\Http\Message\ResponseInterface
    {
        $this->where = [];
        $tabType = $this->request->input('tabType', 'all');
        $limit = $this->request->input('limit', 10);
        try {
            $result = $this->obj_bus->getGoodsIndex(intval($limit), $tabType);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }
}