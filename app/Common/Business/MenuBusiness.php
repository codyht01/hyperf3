<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/1
 * Time: 11:55
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Common\Lib\Tree;
use App\Constants\ErrorCode;
use App\Exception\FooException;
use App\Model\Menu;
use Hyperf\Utils\ApplicationContext;

class MenuBusiness extends BusBase
{
    protected $obj_model = null;


    public function __construct()
    {
        $this->obj_model = new Menu();
    }

    /**
     * @return array
     */
    public function getMenuListAll(): array
    {
        try {
            $menu = $this->obj_model
                ->orderBy('sort', 'asc')
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            throw new FooException("查询失败");
        }
        return $menu;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function add(array $data = []): bool
    {
        if (empty($data)) {
            throw new FooException("请传入值");
        }
        if (empty($data['name'])) {
            throw new FooException("请输入路由名称");
        }
        if (empty($data['menuType'])) {
            throw new FooException("请选择菜单类型");
        }
        if ($data['menuType'] == 'menu') {
            if (empty($data['meta'])) {
                throw new FooException("内部异常");
            }
            if (empty($data['meta']['title'])) {
                throw new FooException("请输入菜单名称");
            }
            if (empty($data['path'])) {
                throw new FooException("请输入路由路径");
            }
            if (empty($data['meta']['icon'])) {
                throw new FooException("请选择图标");
            }
            if (empty($data['component'])) {
                throw new FooException("请输入组件路径");
            }
        }
        if (empty($data['menuSuperior'])) {
            $data['pid'] = 0;
        } else {
            $data['pid'] = end($data['menuSuperior']);
        }
        $insert_data = [
            'title' => $data['meta']['title'],
            'pid' => $data['pid'] ?? 0,
            'menuType' => $data['menuType'],
            'path' => $data['path'],
            'name' => $data['name'],
            'component' => $data['component'],
            'redirect' => $data['redirect'],
            'isLink' => $data['isLink'],
            'link_url' => $data['meta']['link_url'],
            'isHide' => $data['meta']['isHide'],
            'isKeepAlive' => $data['meta']['isKeepAlive'],
            'isAffix' => $data['meta']['isAffix'],
            'isIframe' => $data['meta']['isIframe'],
            'icon' => $data['meta']['icon'],
            'sort' => $data['sort']
        ];
        try {
            if (intval($data['id']) != 0) {
                $res = $this->obj_model->where('id', $data['id'])->update($insert_data);
            } else {
                $insert_data['update_time'] = time();
                $insert_data['create_time'] = time();
                $res = $this->obj_model->insert($insert_data);
            }
        } catch (\Exception $e) {
            throw new FooException("内部异常" . $e->getMessage());
        }
        if (!$res) {
            throw new FooException("操作失败");
        }
        return true;

    }

    /**
     * 获取菜单列表
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getMenuListInfo(): array
    {
        try {
            $row = $this->obj_model
                ->where('status', ErrorCode::MYSQL_SUCCESS)
                ->orderBy('sort', 'asc')
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            throw new FooException("查询失败" . $e->getMessage());
        }
        if (empty($row)) {
            return [];
        }
        $lists = [];
        foreach ($row as $item) {
            $lists[] = [
                "id" => $item['id'],
                "path" => $item['path'],
                "name" => $item['name'],
                "component" => $item['component'],
                "redirect" => $item['redirect'],
                "isLink" => $item['isLink'] == 1,
                "meta" => [
                    "title" => $item['title'],
                    "link_url" => $item['link_url'],
                    "isHide" => $item['isHide'] == 1,
                    "isKeepAlive" => $item['isKeepAlive'] == 1,
                    "isAffix" => $item['isAffix'] == 1,
                    "isIframe" => $item['isIframe'] == 1,
                    "icon" => $item['icon'],
                    "isLink" => $item['isLink'] == 1
                ],
                "pid" => $item['pid'],
                "menuType" => $item['menuType'],
                "sort" => $item['sort'],
                "component_url" => $item['component'],
            ];
        }
        return ApplicationContext::getContainer()->get(Tree::class)->arrayMenu($lists, 0, 'pid', 'children');
    }
}