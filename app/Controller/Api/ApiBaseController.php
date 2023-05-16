<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/7
 * Time: 15:32
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Lib\Show;
use App\Controller\AbstractController;
use App\Request\UserRequest;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;

class ApiBaseController extends AbstractController
{
    protected array $where = [];
    protected int $limit = 10;
    protected array $filed = ['*'];

    /**
     * @param array $where
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): \Psr\Http\Message\ResponseInterface
    {
        $limit = $this->request->input('limit', 10);
        $this->limit = $limit;
        try {
            $result = $this->obj_bus->index($this->limit, $this->where, $this->filed);
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
    public function del(): \Psr\Http\Message\ResponseInterface
    {
        $id = $this->request->input('id', 0);
        try {
            $result = $this->obj_bus->del($id);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok');
    }

    /**
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function insert_add(array $data = []): \Psr\Http\Message\ResponseInterface
    {
        try {
            $this->obj_bus->add($data);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok');
    }

}