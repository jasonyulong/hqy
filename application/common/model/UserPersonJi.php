<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class UserPersonJi extends Model
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
}