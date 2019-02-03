<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-2
 * Time: 下午3:52
 */

namespace app\api\controller;

use think\Controller;
class Category extends Controller
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Category');
    }

    public function getCategoryByParentId()
    {
        $id = input('post.id',0,'intval');
        if (!intval($id)){
            $this->error('参数非法');
        }
        //用过ID获取
//        $categorys = $this->obj->getNormalCitysByParebtId($id);
        $categorys = model('category')->getNormalCitysByParebtId($id);
        if (!$categorys){
            return show(0,'error');
        }
        return show(1,'success',$categorys);
    }
}