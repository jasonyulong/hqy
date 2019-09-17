<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class UserGeti extends Model
{
    protected $classname;
    function initialize(){
        $this->classname=explode('\\',__CLASS__);
        $this->classname=end($this->classname);
    }

    function edit($data,$field=true){
        if(empty($data["user_id"])){
            $this->error="用户ID不能为空";
            return false;
        }
        $isfind=$this->get(["user_id"=>$data["user_id"]]);
        if(empty($isfind)){
            $this->save(["user_id"=>$data["user_id"],"name"=>"","zhusuo"=>"","jingying"=>"","youbian"=>"","shouji"=>"","zhiben"=>0,"leixing"=>"","hesuan"=>"","renshu"=>0,"hangye"=>"","fanwen"=>"","faren_name"=>"","faren_code"=>"","state"=>0]);
        }
        $isfind=$this->get(["user_id"=>$data["user_id"]]);

        $data=initData($field,$data);
        $data["id"]=$isfind["id"];

        $this->validate($this->classname.".".__FUNCTION__);
        $res = $this->allowField($field)->isUpdate()->save($data);
        if( $res!==false && !empty($data["hehuo"])){
            foreach($data["hehuo"] as $v){
                if(!empty($v)){
                    if($v["hehuoren_name"]&&$v["hehuoren_code"]){
                        db("UserGetiHehuoren")->insert(["geti_id"=>$isfind["id"],"name"=>$v["hehuoren_name"],"code"=>$v["hehuoren_code"]]);
                    }
                }
            }
        }
        return $res;
    }



    protected function getHesuanAttr($value){
        $ary=[0=>"独立核算",1=>"非独立核算"];
        return $ary[$value];
    }
}