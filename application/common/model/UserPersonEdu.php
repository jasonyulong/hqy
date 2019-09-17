<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class UserPersonEdu extends Model
{
    protected $classname;
    function initialize(){
        $this->classname=explode('\\',__CLASS__);
        $this->classname=end($this->classname);
    }

    function add($data,$field=true){
        $data=initData($field,$data);
        $this->validate($this->classname.".".__FUNCTION__);
        $res = $this->allowField($field)->save($data);
        return $res;
    }

    function edit($data,$field=true){
        $data=initData($field,$data);
        $this->validate($this->classname.".".__FUNCTION__);
        $res=$this->allowField($field)->isUpdate()->save($data);
        return $res;
    }

    function del($id){
        $info=$this->where(array('id'=>$id))->find();
        $res=$this->where(array('id'=>$info["id"]))->delete();
        return $res;
    }

    protected function getBeginAttr($value){
        return date("Y-m-d h:i:s",$value);
    }
    protected function setBeginAttr($value){
        return strtotime($value);
    }
    protected function getEndAttr($value){
        return date("Y-m-d h:i:s",$value);
    }
    protected function setEndAttr($value){
        return strtotime($value);
    }
}