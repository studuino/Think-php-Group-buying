<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-1
 * Time: 下午7:20
 */

namespace app\admin\controller;


class Category
{
    public function index()
    {
        return view();
    }

    public function add()
    {
        return view('add');
    }

    public function save()
    {
//        print_r($_POST);
//        dump(input('post.'));
//        dump(request()->post());
        $data = input('post.');

    }
}