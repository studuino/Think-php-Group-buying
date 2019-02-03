<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\File;
class Image extends Controller
{
    public function upload()
    {
        $file = Request::instance()->file('file');
        //给定一个dir
        $info = $file->move('upload');#在入口文件public文件下new dir
//        dump($info);
        if($info && $info->getPathname())
        {
            return show(1,'success','/'.$info->getPathname());
        }
        return show(0,'upload,error');
    }
}