<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-3
 * Time: 上午10:02
 */

namespace app\common\model;
/**
 * 公共的model
 */
use think\Model;
class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;
    public function add($data)
    {
        $data['status'] = 0;
        $this->save($data);
        return $this->id;
    }
}