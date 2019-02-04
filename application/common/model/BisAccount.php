<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-3
 * Time: 上午9:38
 */

namespace app\common\model;

use think\Model;
class BisAccount extends BaseModel
{
    public function updateById($data,$id)
    {
        //allowField过滤data数组中非数据表中的数据
        return $this->allowField(true)->save($data,['id'=>$id]);
    }
}