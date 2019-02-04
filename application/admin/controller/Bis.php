<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-3
 * Time: 上午10:24
 */

namespace app\admin\controller;

use think\Controller;
class Bis extends Controller
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Bis');
    }
    //入驻申请列表
    public function apply()
    {
        $bis = $this->obj->getBisByStatus();
        return $this->fetch('',[
            'bis'=>$bis
        ]);
    }

    //通过审核的商户列表
    public function index()
    {
        $bis = $this->obj->getBisByStatus(1);
        return $this->fetch('',[
            'bis'=>$bis
        ]);
    }

    public function detail()
    {
        $id = input('get.id',0,'intval');
        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级栏目的数据
        $categorys = model('Category')->getNormalCitysByParebtId();
        //获取商户数据
        // 三张表组成
        $bisData = model('Bis')->get($id);
        if (empty($bisData)){
            $this->error('ID错误');
        }
        $locationData = model('BisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
        $accountData = model('BisAccount')->get(['bis_id'=>$id,'is_main'=>1]);
        return $this->fetch('',[
            'citys' => $citys,
            'categorys' => $categorys,
            'bisData'=>$bisData,
            'locationData'=>$locationData,
            'accountData'=>$accountData
        ]);
    }

    //修改状态
    public function status()
    {
        $id = input('get.id');
        $status = input('get.status');
        $res = model('Bis')->save(['status'=>$status],['id'=>$id]);
        $location = model('BisLocation')->save(['status'=>$status],['bis_id'=>$id,'is_main'=>1]);
        $account = model('BisLocation')->save(['status'=>$status],['bis_id'=>$id,'is_main'=>1]);
        if ($res && $location && $location){
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }

    }
}