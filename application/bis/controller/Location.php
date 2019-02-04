<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-3
 * Time: 下午9:21
 */

namespace app\bis\controller;

class Location extends Base
{
    public function index()
    {
        return '001';
    }
    /**
     * 列表页
     */
    public function add()
    {
        if (request()->isPost()){
            //门店入库操作
            //第一步 validate校验
            $data = input('post.');
            $bisId = $this->getLoginUser()->bis_id;
            $data['cat'] = '';
            if(!empty($data['se_category_id'])) {
                $data['cat'] = implode('|', $data['se_category_id']);
            }
            //
            $locationData = [
                'bis_id' => $bisId,
                'name' => $data['name'],
                'logo' => $data['logo'],
                'tel' => $data['tel'],
                'contact' => $data['contact'],
                'category_id' => $data['category_id'],
                'category_path' => $data['category_id'] . ',' . $data['cat'],
                'city_id' => $data['city_id'],
                'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
                'api_address' => $data['address'],
                'open_time' => $data['open_time'],
                'content' => empty($data['content']) ? '' : $data['content'],
                'is_main' => 0,// 1代表的是总店信息 0代表分店
            ];

            $locationId = model('BisLocation')->add($locationData);
            if($locationId){
                return $this->success('门店申请成功');
            }else{
                return $this->error('门店申请失败');
            }
        }else{
            //获取一级城市的数据
            $citys = model('City')->getNormalCitysByParentId();
            //获取一级栏目的数据
            $categorys = model('Category')->getNormalCitysByParebtId();
            return $this->fetch('',[
                'citys' => $citys,
                'categorys' => $categorys,
            ]);
        }


    }
}