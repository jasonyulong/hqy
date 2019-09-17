<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class UserLogin extends Model
{
    protected $insert = ['ip','time'];

    protected function setIpAttr(){
        return request()->ip();
    }
    protected function setTimeAttr(){
        return time();
    }
}