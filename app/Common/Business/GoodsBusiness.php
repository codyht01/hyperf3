<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/29
 * Time: 14:38
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;


use App\Common\Lib\Log\Log;
use App\Common\Lib\Show;
use App\Exception\FooException;
use App\Model\Good;
use Hyperf\DbConnection\Db;
use function Swoole\Coroutine\map;

class GoodsBusiness extends BusBase
{
    protected $obj_model = "";

    public function __construct()
    {
        $this->obj_model = new Good();
    }

    public function getGoodsIndex(int $limit = 10, string $tabType = '', array $field = ['*'], string $orderKey = 'id', string $order_value = 'desc'): array
    {
        $where = null;
        $result = [];
        try {
            if ($tabType == 'all') {
                $result = $this->obj_model
                    ->whereIn('status', [0, 1])
                    ->orderBy($orderKey, $order_value)
                    ->paginate($limit, $field)->toArray();
            } else if ($tabType == 'second') {
                $result = $this->obj_model
                    ->where('status', '=', 2)
                    ->orderBy($orderKey, $order_value)
                    ->paginate($limit, $field)->toArray();
            } else if ($tabType == 'del') {
                $result = $this->obj_model
                    ->where('status', '=', 3)
                    ->orderBy($orderKey, $order_value)
                    ->paginate($limit, $field)->toArray();
            } else if ($tabType == '') {

            }
        } catch (\Exception $e) {
            throw new FooException("查询失败");
        }
        return $result;
    }

    public function getInfo(int $id = 0)
    {
        if ($id == 0) {
            throw new FooException("内部异常");
        }
        $row = $this->getBaseById($id);
        $sku_data = [];
        if (!empty($row)) {
            if ($row['specification'] === 2) {
                $goods_sku = (new GoodsSkusBusiness())->getBaseByListInfo([
                    ['goods_id', '=', $row['id']]
                ]);
                $obj_specs_value = new SpecsValueBusiness();
                if (!empty($goods_sku)) {
                    //查询规格 todo 获取所有规格
                    $specs_ids = implode(',', array_column($goods_sku, 'specs_id'));
                    $arr_specs = array_unique(explode(',', $specs_ids));
                    $specs_value = $obj_specs_value->getSpecsByInfo($arr_specs);
                    if (!empty($specs_value)) {
                        foreach ($specs_value as $v) {
                            $v['checked'] = true;
                            if (isset($sku_data[$v['specs']['title']])) {
                                $sku_data[$v['specs']['title']]['child'][] = $v;
                            } else {
                                $sku_data[$v['specs']['title']] = [
                                    "title" => $v['specs']['title'],
                                    "child" => [$v]
                                ];
                            }
                        }
                    }
                    if (!empty($arr_specs)) {
                        $specs_name = $obj_specs_value->getSpecsBySpecsName($arr_specs);

                        foreach ($goods_sku as $k => $v) {
                            $specs_list = [];
                            if (!empty($v['specs_id'])) {
                                $specs_ids = explode(',', $v['specs_id']);
                                foreach ($specs_ids as $item) {
                                    $specs_list[] = [
                                        'id' => $item,
                                        'title' => $specs_name[$item]
                                    ];
                                }
                            }
                            $goods_sku[$k]['data_title'] = $specs_list;
                        }
                    }
                }
                $row['sku_data'] = array_values($sku_data);
                $row['sku'] = $goods_sku;

            } else {

            }
            if (!empty($row['description'])) {
                $row['description'] = htmlspecialchars_decode($row['description']);
            }
            if (!empty($row['banner'])) {
                $row['banner'] = Show::json_decode($row['banner']);
                foreach ($row['banner'] as $k => $v) {
                    $row['banner'][$k] = [
                        "url" => $v
                    ];
                }
            }
            return $row;
        } else {
            throw new FooException("商品信息不存在");
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function add(array $data = []): bool
    {
        if (!empty($data['id']) && $data['id'] == 0) {
            unset($data['id']);
        }
        //判断是否选择了上传视频
        if ($data['is_video'] == 1) {
            if ($data['video_type'] == 1) {
                if (empty($data['video_url'])) {
                    throw new FooException("请上传视频");
                }
            } else {
                if (empty($data['video_url'])) {
                    throw new FooException("请输入视频地址");
                }
                if (!preg_match('/^https?:\/\/(.+\/)+.+(\.(swf|avi|flv|mpg|rm|mov|wav|asf|3gp|mkv|rmvb|mp4))$/i', $data['video_url'])) {
                    throw new FooException("请输入正确的地址");
                }
            }
        }
        //是否限购
        if ($data['is_purchase'] == 1) {
            if ($data['purchase_number'] == 0) {
                throw new FooException("请输入限购数量");
            }
        }
        //是否是预售
        if ($data['is_booking'] == 1) {
            if (empty($data['booking_time'])) {
                throw new FooException("请选择预售时间");
            }
        }
        //是否上传了banner
        if (empty($data['banner'])) {
            throw new FooException("请上传轮播图");
        }
        $banner_url = array_column($data['banner'], 'url');

        $data['banner'] = Show::json_encode($banner_url);
        if (!empty($data['recommend'])) {
            $data['recommend'] = Show::json_encode($data['recommend']);
        }
        if (!empty($data['logistics_type'])) {
            $data['logistics_type'] = Show::json_encode($data['logistics_type']);
        }
        if (!empty($data['description'])) {
            $data['description'] = htmlspecialchars($data['description']);
        }
        $sku_data = [];
        $goods_img = "";
        if ($data['specification'] === 1) { //单规格
            if ($data['price'] === 0) {
                throw new FooException("请输入售价");
            }
            if ($data['market_price'] === 0) {
                throw new FooException("请输入成本价");
            }
            if ($data['cost_price'] === 0) {
                throw new FooException("请输入原价");
            }
            if ($data['stock'] === 0) {
                throw new FooException("请输入库存");
            }
            if (empty($data['goods_img'])) {
                throw new FooException("请上传商品图片");
            }
            $goods_img = $data['goods_img'];
        } else { //多规格
            if (empty($data['sku_data'])) {
                throw new FooException("请选择规格");
            }
            $is_false = false;
            $count_stock = 0;
            foreach ($data['sku_data'] as $v) {
                if (empty($v['specs_id'])) {
                    $is_false = true;
                    break;
                }
                if (empty($v['price'])) {
                    $is_false = true;
                    break;
                }
                if (empty($v['stock'])) {
                    $is_false = true;
                    break;
                }
                if (empty($v['cost_price'])) {
                    $is_false = true;
                    break;
                }
                if (empty($v['image'])) {
                    $is_false = true;
                    break;
                }
                if (empty($v['market_price'])) {
                    $is_false = true;
                    break;
                }
                $count_stock += $v['stock'];
                $data['price'] = $v['price'];
                $data['market_price'] = $v['market_price'];
                $data['cost_price'] = $v['cost_price'];
                $data['stock'] = $count_stock;
                $sku_data[] = [
                    'id' => $v['id'] ?? 0,
                    'price' => $v['price'],
                    'market_price' => $v['market_price'],
                    'cost_price' => $v['cost_price'],
                    'stock' => $v['stock'],
                    'image' => $v['image'],
                    'goods_id' => 0,
                    'specs_id' => $v['specs_id'],
                    'create_time' => time(),
                    'update_time' => time()
                ];
            }
            if ($is_false) {
                throw new FooException("请输入完规格在提交");
            }
        }
        if (!empty($data['booking_time'])) {
            $data['booking_time_start'] = strtotime($data['booking_time'][0]);
            $data['booking_time_end'] = strtotime($data['booking_time'][1]);
        }
        $casts = array_keys($this->obj_model->getCasts());
        foreach ($data as $k => $v) {
            if (!in_array($k, $casts)) {
                unset($data[$k]);
            }
        }
        $obj_goods_sku = new GoodsSkusBusiness();
        //添加入库
        Db::beginTransaction();
        try {
            //添加入库
            $data['create_time'] = time();
            $data['update_time'] = time();
            if (!empty($data['id'])) {
                $this->obj_model->where('id', $data['id'])->update($data);
                $goods_id = $data['id'];
            } else {
                $goods_id = $this->obj_model->insertGetId($data);
            }
            if (!$goods_id) {
                throw new FooException("添加失败");
            }
            $update_sku = [];
            if (!empty($data['id'])) {
                if ($data['specification'] == 1) {
                    $insert_goods_sku = [[
                        'price' => $data['price'],
                        'market_price' => $data['market_price'],
                        'cost_price' => $data['cost_price'],
                        'stock' => $data['stock'],
                        'image' => $goods_img,
                        'goods_id' => $goods_id,
                        'create_time' => time(),
                        'update_time' => time(),
                    ]];
                    $obj_goods_sku->updateData($insert_goods_sku[0], $goods_id);
                } else {
                    if ($sku_data[0]['id'] != 0) {
                        //更新sku
                        //更新多个sku
                        foreach ($sku_data as $k => $v) {
                            $v['goods_id'] = $goods_id;
                            $obj_goods_sku->updateDataBySkuData($v, $v['id']);
                        }

                    } else {
                        //直接删除 然后新增
                        $obj_goods_sku->delByData($goods_id);
                        $insert_goods_sku = [];
                        foreach ($sku_data as $k => $v) {
                            $insert_goods_sku[$k] = $v;
                            $insert_goods_sku[$k]['goods_id'] = $goods_id;
                        }
                    }
                }
            } else {
                if ($data['specification'] === 1) {
                    $insert_goods_sku = [[
                        'price' => $data['price'],
                        'market_price' => $data['market_price'],
                        'cost_price' => $data['cost_price'],
                        'stock' => $data['stock'],
                        'image' => $goods_img,
                        'goods_id' => $goods_id,
                        'create_time' => time(),
                        'update_time' => time()
                    ]];
                } else {
                    $insert_goods_sku = [];
                    foreach ($sku_data as $k => $v) {
                        $insert_goods_sku[$k] = $v;
                        $insert_goods_sku[$k]['goods_id'] = $goods_id;
                    }
                }
//                $insert_sku_id = $obj_goods_sku->insertGetId($insert_goods_sku);
//                if (!$insert_sku_id) {
//                    throw new FooException("操作失败");
//                }
//                $insert_goods_sku_count = count($insert_goods_sku) - 1;
//                //更新主表
//                $this->obj_model->where('id', $goods_id)->update([
//                    'stock' => array_sum(array_column($insert_goods_sku, 'stock')),
//                    'sku_id' => $insert_sku_id,
//                    'url' => $insert_goods_sku[$insert_goods_sku_count]['image'],
//                    'market_price' => $insert_goods_sku[$insert_goods_sku_count]['market_price'],
//                    'cost_price' => $insert_goods_sku[$insert_goods_sku_count]['cost_price'],
//                ]);
            }
            if (!empty($insert_goods_sku)) {
                $insert_sku_id = $obj_goods_sku->insertGetId($insert_goods_sku);
                if (!$insert_sku_id) {
                    throw new FooException("操作失败");
                }
                $insert_goods_sku_count = count($insert_goods_sku) - 1;
                //更新主表
                $this->obj_model->where('id', $goods_id)->update([
                    'stock' => array_sum(array_column($insert_goods_sku, 'stock')),
                    'sku_id' => $insert_sku_id,
                    'url' => $insert_goods_sku[$insert_goods_sku_count]['image'],
                    'market_price' => $insert_goods_sku[$insert_goods_sku_count]['market_price'],
                    'cost_price' => $insert_goods_sku[$insert_goods_sku_count]['cost_price'],
                ]);
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            Log::get('goods_add', 'error')->error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
            throw new FooException("操作失败" . $e->getMessage());
        }
        return true;
    }

    /**
     * 回收商品
     * @param int|string $id
     * @return bool
     */
    public function del(int|string $id = 0): bool
    {
        if ($id == 0) {
            throw new FooException("内部异常");
        }
        try {
            $res = $this->obj_model
                ->whereIn('id', explode(',', $id))->update([
                    'status' => 3
                ]);
        } catch (\Exception $e) {
            throw new FooException("删除异常");
        }
        if (!$res) {
            throw new FooException("删除失败");
        }
        return true;

    }
}