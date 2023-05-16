<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/1
 * Time: 16:28
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Lib;

class Tree
{
    /**
     * @param int $pid
     * @param array $list
     * @return array|\int[][]|\string[][]
     */
    public function getPidMenuList(int $pid = 0, array $list = []): array
    {
        return $this->buildPidMenu($pid, $list);
    }

    /**
     * @param $pid
     * @param $list
     * @param int $level
     * @return array
     */
    protected function buildPidMenu($pid, $list, $level = 0): array
    {
        $newList = [];
        foreach ($list as $vo) {
            if ($vo['pid'] == $pid) {
                $level++;
                foreach ($newList as $v) {
                    if ($vo['pid'] == $v['pid'] && isset($v['level'])) {
                        $level = $v['level'];
                        break;
                    }
                }
                $vo['level'] = $level;
                if ($level > 1) {
                    $repeatString = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    $markString = str_repeat("{$repeatString}├{$repeatString}", $level - 1);
                    $vo['title'] = $markString . $vo['title'];
                }
                $newList[] = $vo;
                $childList = $this->buildPidMenu($vo['id'], $list, $level);
                !empty($childList) && $newList = array_merge($newList, $childList);
            }

        }
        return $newList;
    }

    /**
     * 对象转换
     * @param $arr
     * @param int $pid
     * @param string $parent_key
     * @param string $submenu
     * @return array
     */
    public function objToTree($arr, int $pid = 0, string $parent_key = 'parent_id', string $submenu = 'submenu'): array
    {
        $list = array();
        foreach ($arr as $v) {
            if ($v->$parent_key == $pid) {
                $tmp = $this->objToTree($arr, $v->id, $parent_key, $submenu);
                if ($tmp) {
                    $v->$submenu = $tmp;
                }
                $list[] = $v;
            }
        }
        return $list;
    }

    /**
     * 数组转换
     * @param array $arr
     * @param int $pid
     * @param string $parent_key
     * @param string $submenu
     * @return array
     */
    public function arrayMenu(array $arr = [], int $pid = 0, string $parent_key = 'parent_id', string $submenu = 'submenu'): array
    {
        $list = array();
        foreach ($arr as $v) {
            if ($v[$parent_key] == $pid) {
                $tmp = $this->arrayMenu($arr, $v['id'], $parent_key, $submenu);
                if ($tmp) {
                    $v[$submenu] = $tmp;
                }
                $list[] = $v;
            }
        }
        return $list;
    }
}