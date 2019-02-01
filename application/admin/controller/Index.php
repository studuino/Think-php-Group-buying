<?php
namespace app\admin\controller;

class Index
{
    public function index()
    {
        return view('index');
    }

    public function welcome()
    {
        return '<h1>This is app\admin\index\test</h1>';
    }
}
