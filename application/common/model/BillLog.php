<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */
namespace app\common\model;

use think\Model;

class BillLog extends Model
{
    protected $classname;
    function initialize(){
        $this->classname=explode('\\',__CLASS__);
        $this->classname=end($this->classname);
    }

    function add($data){
        $res = $this->allowField(true)->save($data);
        return $res;
    }

    protected function getIsbillAttr($value){
        $ary=[0=>"未开票",1=>"已开票"];
        return $ary[$value];
    }
}