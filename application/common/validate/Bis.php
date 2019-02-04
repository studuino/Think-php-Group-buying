<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-2
 * Time: 下午7:59
 */
namespace app\common\validate;

use think\Validate;
class Bis extends Validate
{
    protected $rule = [
        'name' => 'require|max:25',
        'email'=> 'email|require',
        'logo' => 'require',
        'city_id' => 'require',
        'faren' => 'require'
    ];
    //场景设置
    protected $scene = [
      'add' => ['name','email','faren']
    ];
}