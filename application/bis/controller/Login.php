<?php
namespace app\bis\controller;

use think\Controller;
class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()){
            //处理登录逻辑
            //获取相关数据
            $data = input('post.');
            //通过用户名 获取用户相关信息

            //严格校验 此处省略
            $ret = model('BisAccount')->get(['username'=>$data['username']]);
            if (!$ret || $ret->status!=1){
                $this->error($ret->status.'该用户不存在或者用户未被审核通过');
            }
            if($ret->password != md5($data['password'].$ret->code)){
                $this->error('该用户不存在或者用户未被审核通过');
            }
            model('BisAccount')->updateById(['last_login_time'=>time()],$ret->id);
            //保存用户信息
            session('bisAccount',$ret,'bis');//key,value,作用域[如实例作用域为BIS模块]
            $this->success('登录成功',url('index/index'));
        }else{
            //获取session值
            $account = session('bisAccount','','bis');
            if ($account && $account->id){
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }
    }

    public function loginout()
    {
        $account = session('bisAccount','','bis');
        if ($account && $account->id){
            session(null, 'bis');
            $this->redirect('login/index');
        }
    }
}