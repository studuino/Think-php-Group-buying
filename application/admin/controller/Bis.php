<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-3
 * Time: 上午10:24
 */

namespace app\admin\controller;

use think\Controller;
class Bis extends Controller
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Bis');
    }
    //入驻申请列表
    public function apply()
    {
        return $this->fetch();
    }
}