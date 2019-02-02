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