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


namespace App\Controller\Api;

use App\Common\Business\UploaderCateBusiness;
use App\Common\Lib\Show;
use App\Constants\ErrorCode;
use App\Request\UploaderCateRequest;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UploaderCateController extends ApiBaseController
{
    protected ?UploaderCateBusiness $obj_bus = null;

    public function __construct()
    {
        $this->obj_bus = new UploaderCateBusiness();
    }

    /**
     * @param UploaderCateRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function add(UploaderCateRequest $request)
    {
        $title = $this->request->input('title');
        try {
            $result = ApplicationContext::getContainer()->get($this->obj_bus)->add(['title' => $title]);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): \Psr\Http\Message\ResponseInterface
    {
        $limit = $this->request->input('limit', 10);
        $title = $this->request->input('keywords', '');
        $where = [];
        $where[] = ['status', '=', ErrorCode::MYSQL_SUCCESS];
        if (!empty($title)) {
            $where[] = ['title', 'like', '%' . $title . '%'];
        }
        try {
            $result = $this->obj_bus->index($limit, $where);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success('ok', $result);
    }
}