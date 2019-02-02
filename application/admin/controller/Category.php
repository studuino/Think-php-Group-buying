<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-1
 * Time: 下午7:20
 */

namespace app\admin\controller;
use think\Controller;
class Category extends Controller
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model("Category");
    }

    public function index()
    {
        $parentId = input('get.parent_id',0,'intval');
        $categorys = $this->obj->getFirstCategorys($parentId);
        return view('',[
            'categorys'=>$categorys
        ]);
    }

    public function add()
    {
        $categorys = $this->obj->getNormalFirstCategory();
        return view('add',[
            'categorys'=>$categorys,
        ]);
    }

    public function save()
    {
//        print_r($_POST);
//        dump(input('post.'));
//        dump(request()->post());
        /**
         * 做下严格校验
         */
        if(!request()->isPost()){
            $this->error('请求失败');
        }
        $data = input('post.');
//        $data['status'] = 10;
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){ #return bool
            $this->error($validate->getError());
        }
        if (!empty($data['id'])){
            return $this->update($data);
        }
//        dump($data);
        //把$data 提交到 model层
        $res = $this->obj->add($data); #1 or 0
        if ($res){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }

    /**
     * 编辑页面
     */
    public function edit($id = 0)
    {
//        dump(input('get.id'));
//        dump($id);
        if (intval($id) <1 ){
            $this->error('参数不合法');
        }
        $category = $this->obj->get($id);
//        dump($category);
        $categorys = $this->obj->getNormalFirstCategory();
        return view('',[
            'categorys'=>$categorys,
            'category' =>$category
        ]);
    }

    public function update($data)
    {
        $res =  $this->obj->save($data,['id'=>intval($data['id'])]);#date,where
        if ($res)
        {
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }

    }

    //排序逻辑
    public function listorder($id,$listorder)
    {
        $res = $this->obj->save(['listorder'=>$listorder],['id'=>$id]);
        if ($res){
            $this->result($_SERVER['HTTP_REFERER'],1,'SUCCESS');#result 返回json数据 第一个为要跳转的地方,状态码,提示词
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
        }
    }

    //修改状态
    public function status()
    {
//        dump(input('get.'));
        $date = input('get.');
        $validate = validate('Category');
        if(!$validate->scene('status')->check($date)){
            $this->error($validate->getError());
        }
        $res = $this->obj->save(['status'=>$date['status']],['id'=>$date['id']]);
        if ($res){
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }
    }

}