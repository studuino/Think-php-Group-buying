<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-2
 * Time: 下午8:25
 */

namespace app\common\model;

//use think\Model;
//use think\Paginator;
class Bis extends BaseModel
{
    //通过状态获取商家数据
    public function getBisByStatus($status = 0)
    {
        $order = [
            'id'=>'desc'
        ];
        $data = [
            'status'=>$status
        ];
        $result = $this->where($data)->order($order)->paginate(8);
        return $result;
    }
}