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

use App\Common\Business\SpecsValueBusiness;
use App\Common\Lib\Show;
use App\Constants\ErrorCode;
use App\Request\SpecsValueRequest;

class SpecsValueController extends ApiBaseController
{
    protected SpecsValueBusiness $obj_bus;

    public function __construct()
    {
        $this->obj_bus = new SpecsValueBusiness();
    }

    /**
     * @param SpecsValueRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function add(SpecsValueRequest $request): \Psr\Http\Message\ResponseInterface
    {
        $insert_data = [
            'id' => $this->request->input('id', 0),
            'title' => $this->request->input('title', ''),
            'specs_id' => $this->request->input('specs_id', 0)
        ];
        return parent::insert_add($insert_data);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getSpecsValueByListInfo(): \Psr\Http\Message\ResponseInterface
    {
        $specs_id = $this->request->input('specs_id', 0);
        if ($specs_id == 0) {
            return Show::error("请选择规格");
        }
        try {
            $result = $this->obj_bus->getBaseByListInfo([
                ['status', '=', ErrorCode::MYSQL_SUCCESS],
                ['specs_id', '=', $specs_id]
            ], 'sort,id');
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }

}