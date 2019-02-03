<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-2
 * Time: 下午2:46
 */

namespace app\common\model;

use think\Model;
class City extends Model
{
    public function getNormalCitysByParentId($parent_id = 0)
    {
        $data = [
            'status' =>1,
            'parent_id' => $parent_id
        ];
        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)
            ->order($order)
            ->select();
    }
}