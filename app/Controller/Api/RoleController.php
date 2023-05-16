<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/16
 * Time: 17:32
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Business\RoleBusiness;
use App\Common\Lib\Show;
use App\Request\RoleRequest;
use App\Request\UserRequest;
use Hyperf\Utils\ApplicationContext;

class RoleController extends ApiBaseController
{
    protected $obj_bus = null;

    public function __construct()
    {
        $this->obj_bus = new RoleBusiness();
    }

    /**
     * 添加
     * @param UserRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function add(RoleRequest $request): \Psr\Http\Message\ResponseInterface
    {
        $request->validated();
        $data = $this->request->all();
        try {
            $result = $this->obj_bus->add($data);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok');
    }

    /**
     * 删除
     * @param UserRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function del(): \Psr\Http\Message\ResponseInterface
    {
        $id = $this->request->input('id', 0);
        try {
            $result = $this->obj_bus->del(intval($id));
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok');
    }
}