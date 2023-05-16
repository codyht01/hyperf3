<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/22
 * Time: 17:00
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Business\GoodsCategoryBusiness;
use App\Common\Lib\Show;
use App\Request\GoodsCategoryRequest;
use App\Request\UserRequest;
use Hyperf\Di\Annotation\Inject;

class GoodsCategoryController extends ApiBaseController
{
    protected ?GoodsCategoryBusiness $obj_bus = null;

    public function __construct()
    {
        $this->obj_bus = new GoodsCategoryBusiness();
    }

    public function add(GoodsCategoryRequest $request)
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
    public function getGoodsCategoryByList(): \Psr\Http\Message\ResponseInterface
    {
        try {
            $result = $this->obj_bus->getGoodsCategoryByList();
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }

}