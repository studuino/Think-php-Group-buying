<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status ($status)
{
    switch ($status)
    {
        case 1:
            return $status = "<span class='label label-success radius'>正常</span>";
            break;
        case 0:
            return $status = "<span class='label label-info radius'>待审</span>";
            break;
        case -1:
            return $status = "<span class='label label-danger radius'>删除</span>";
            break;
        default:
            return $status = "<span class='label label-danger radius'>非法参数</span>";

    }

}
//商户入驻申请文案
function bisRegister($status){
    switch ($status)
    {
        case 1:
            return $status = "<span class='label label-success radius'>入驻成功</span>";
            break;
        case 0:
            return $status = "<span class='label label-info radius'>待审,审核后平台会发送邮件通知,请关注</span>";
            break;
        case 2:
            return $status = "<span class='label label-danger radius'>非常抱歉,您提交的材料不符合条件,请重新提交</span>";
            break;
        default:
            return $status = "<span class='label label-danger radius'>非法参数</span>";

    }
}

//公用的分页样式
function pagination($obj)
{
    if(!$obj){
        return '';
    }
    return "<div class=\"cl pd-5 bg-1 bk-gray mt-20 tp5-o2o\">{$obj->render()}</div>";
}

function getSeCityName($path)
{
    if (empty($path))
    {
        return '';
    }
    if (preg_match('/,/',$path)){
        $cityPath = explode(',',$path);
        $cityId = $cityPath[1];
    }else{
        $cityId = $path;
    }
    $city = model('City')->get($cityId);
    return $city->name;
}