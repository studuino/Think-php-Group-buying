<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true;#自动time
    public function add($data)
    {
        $data['status'] = 1;
//        $data['create_time'] = time();
        return $this->save($data);
    }

    public function getNormalFirstCategory()
    {
        $data = [
            'status' =>1,
            'parent_id' => 0
        ];
        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)
                    ->order($order)
                    ->select();
    }

    public function getFirstCategorys($parentId = 0)
    {
        $data = [
            'status' => ['neq',-1],#不等于-1
            'parent_id' => $parentId
        ];
        $order = [
            'listorder' => 'desc',
            'id' =>'asc'
        ];
        $result =  $this->where($data)
                    ->order($order)
//                    ->select();
                    ->paginate(5); #listRows每页现实多少条
//        echo $this->getLastSql();

        return $result;
    }

    public function getNormalCitysByParebtId($parent_id = 0)
    {
        $data = [
            'status' => 1,
            'parent_id' => $parent_id
        ];
        $order = [
          'id'=>'desc'
        ];
        return $this->where($data)
                    ->order($order)
                    ->select();
    }

}