<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */
namespace app\common\model;

use think\Model;

class Account extends Model
{
    protected $classname;
    function initialize(){
        $this->classname=explode('\\',__CLASS__);
        $this->classname=end($this->classname);
    }

    function getaccount($uid){
        $mod=$this->get(["uid"=>$uid]);
        if(empty($mod)){
            $this->insert(["uid"=>$uid,"amount"=>0]);
            $mod=$this->get(["uid"=>$uid]);
        }
        return $mod;
    }
}