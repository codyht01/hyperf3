<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/11
 * Time: 11:37
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Business\MenuBusiness;
use App\Common\Lib\Show;
use App\Request\MenuRequest;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

class MenuController extends ApiBaseController
{
    protected $obj_bus = null;


    public function __construct()
    {
        $this->obj_bus = new MenuBusiness();
    }

    /**
     * 返回菜单列表
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index(): \Psr\Http\Message\ResponseInterface
    {
        try {
            $list = $this->obj_bus->getMenuListAll();
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success("ok", $list);
    }

    /**
     * 获取前端接口的菜单
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getMenuListInfo(): \Psr\Http\Message\ResponseInterface
    {
        try {
            $tree_menu = $this->obj_bus->getMenuListInfo();
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $tree_menu);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function addMenu()
    {
        return Show::success();
        $data = $this->request->all();
        $lists = [];
        $id = 1;
        foreach ($data['data'] as $k => $v) {
            $pid = 0;
            if (!empty($v['children'])) {
                $lists[] = $this->__path($v, $id, 0);
                $pid = $id;
                $id++;
                foreach ($v['children'] as $item) {
                    $lists[] = $this->__path($item, $id, $pid);
                    $id++;
                }
            } else {
                $lists[] = $this->__path($v, $id, 0);
                $id++;
            }
        }
        $res = (new MenuBusiness())->add($lists);
        var_dump($res);
    }

    protected function __path(array $v = [], int $id = 1, int $pid = 0)
    {
        return [
            "id" => $id,
            "pid" => $pid,
            "path" => $v['path'],
            "name" => $v['name'],
            "component" => $v['component'],
            "redirect" => $v['redirect'] ?? '',
            "title" => $v['meta']['title'],
            "isLink" => $v['meta']['isLink'],
            "isHide" => $v['meta']['isHide'],
            "isKeepAlive" => $v['meta']['isKeepAlive'],
            "isAffix" => $v['meta']['isAffix'],
            "isIframe" => $v['meta']['isIframe'],
            "icon" => $v['meta']['icon'] ?? '',
        ];
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function add()
    {
        try {
            $this->obj_bus->add($this->request->all());
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok');
    }
}