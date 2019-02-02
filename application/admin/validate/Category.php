<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-1
 * Time: 下午7:38
 */
namespace app\admin\validate;
use think\Validate;
class Category extends Validate
{
    protected $rule = [
        ['name','require|max:10','分类名不能为空|分类名不能超过10个字符'],#id,规则,提示词
        ['parent_id','number'],
        ['id','number'],
        ['status','number|in:-1,0,1','状态必须为数字|状态范围不合法'], #in 范围-1,0,1
        ['listorder','number'],
    ];
//    场景设置
    protected $scene = [
        'add' => ['name','parent_id','id'],//添加功能场景设置
        'listorder' => ['id','listorder'],//排序
        'status' => ['id','status'],//status设置
    ];
}