<?php
namespace app\index\controller;

use think\Controller;
class User extends Controller
{
    public function login()
    {
        return $this->fetch('login');
    }

    public function register()
    {
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);
            $verifyCode = $data['verifyCode'];
            if(!captcha_check($verifyCode)){
                $this->error("校验失败");
            }else{
                echo 'success';
            }
        }else{
            return $this->fetch('register');
        }
    }
}
