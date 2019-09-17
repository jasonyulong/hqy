<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class UserPerson extends Model
{
    protected $classname;
    function initialize(){
        $this->classname=explode('\\',__CLASS__);
        $this->classname=end($this->classname);
    }
    protected $insert = ['state'];

    function edit($data,$field=true){
        if(empty($data["user_id"])){
            $this->error="用户ID不能为空";
            return false;
        }
        $isfind=$this->get(["user_id"=>$data["user_id"]]);
        if(empty($isfind)){
            $this->save(["user_id"=>$data["user_id"],"name"=>"","code"=>"","pic"=>"","picf"=>"","job"=>"","jobname"=>"","jtype"=>"","jtime"=>"","timelong"=>"","jobarea"=>"","jobaddress"=>"","money"=>"","des"=>"","state"=>0]);
        }
        $isfind=$this->get(["user_id"=>$data["user_id"]]);

        $data=initData($field,$data);
        $data["id"]=$isfind["id"];

        $pic=Filem::file_move($data["pic"],$this->classname);
        if($pic){
            $data["pic"]=$pic[0];
        }else{
            $data["pic"]="";
        }
        $picf=Filem::file_move($data["picf"],$this->classname);
        if($picf){
            $data["picf"]=$picf[0];
        }else{
            $data["picf"]="";
        }

        $this->validate($this->classname.".".__FUNCTION__);
        $res = $this->allowField($field)->isUpdate()->save($data);
        return $res;
    }


    protected function setStateAttr($value){
        return empty($value)?0:$value;
    }
    protected function getStateAttr($value){
        $ary=[0=>"未审核",1=>"通过"];
        return $ary[$value];
    }
}