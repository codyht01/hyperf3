<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/11
 * Time: 11:38
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Business\UserBusiness;
use App\Common\Lib\Show;
use App\Exception\FooException;
use App\Request\UserRequest;
use Hyperf\Utils\ApplicationContext;
use Qbhy\HyperfAuth\AuthManager;

class UserController extends ApiBaseController
{
    protected ?UserBusiness $obj_bus = null;

    /**
     *
     */
    public function __construct()
    {
        $this->obj_bus = new UserBusiness();
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws FooException
     */
    public function getUserInfo(): \Psr\Http\Message\ResponseInterface
    {
        try {
            $result = $this->obj_bus->getUserInfo();
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }

    public function index(): \Psr\Http\Message\ResponseInterface
    {
        $limit = $this->request->input('limit', 10);
        try {
            $result = $this->obj_bus->index($limit, [], ['id', 'userName', 'last_login_ip', 'last_login_time', 'status', 'create_time']);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }

    /**
     * 添加
     * @param UserRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function add(UserRequest $request): \Psr\Http\Message\ResponseInterface
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
     * 更新用户信息
     * @param UserRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function updateUserInfo(UserRequest $request): \Psr\Http\Message\ResponseInterface
    {
        try {
            $result = $this->obj_bus->updateUserInfo($this->request->all());
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('更新成功');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getUserListInfo(): \Psr\Http\Message\ResponseInterface
    {
        try {
            $result = $this->obj_bus->getUserListInfo();
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }

}