<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-2
 * Time: 下午3:06
 */

namespace app\api\controller;

use think\Controller;
class City extends Controller
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('City');
    }

    public function getCitysByParentId()
    {
        $id = input('post.id');
        if (empty($id)||!intval($id)){
            $this->error('ID不合法'.$id);
        }
        //通过ID获取二级城市
        $citys = $this->obj->getNormalCitysByParentId($id);
        if (!$citys){
            return show(0,'数据异常');
        }
        return show(1,'success',$citys);
    }
}