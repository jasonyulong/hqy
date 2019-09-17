<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class GoodsOrder extends Model
{
    protected $insert = ['time','file','over','source','price','pay','state','ok'];
    protected $classname;
    function initialize(){
        $this->classname=explode('\\',__CLASS__);
        $this->classname=end($this->classname);
    }

    function add($data,$field=true){
        $data=initData($field,$data);
        $this->validate($this->classname.".".__FUNCTION__);

        $find=db("GoodsOrder")->where(["goods_id"=>$data["goods_id"],"user_id"=>$data["user_id"]])->find();
        if($find){
            $this->error="不能重复申请";
            return false;
        }
        if(!empty($find["order_id"])){
            $this->error="这个项目已经选单不能申请";
            return false;
        }

        $res = $this->allowField($field)->save($data);
        return $res;
    }

    function del($id){
        $info=$this->where(array('id'=>$id))->find();
        $res=$this->where(array('id'=>$info["id"]))->delete();
        return $res;
    }

    protected function setUserIdAttr($value){
        return isset($value)?$value:0;
    }
    protected function setFileAttr($value){
        return isset($value)?$value:"";
    }
    protected function setOverAttr($value){
        return isset($value)?$value:"";
    }
    protected function setSourceAttr($value){
        return isset($value)?$value:"";
    }
    protected function setPriceAttr($value){
        return isset($value)?$value:0;
    }
    protected function setPayAttr($value){
        return isset($value)?$value:0;
    }
    protected function getPayAttr($value){
        $ary=[0=>"未支付",1=>"已支付"];
        return $ary[$value];
    }
    protected function setStateAttr($value){
        return isset($value)?$value:0;
    }
    protected function getStateAttr($value){
        $ary=[0=>"正常",1=>"已完结"];
        return $ary[$value];
    }
    protected function setOkAttr($value){
        return isset($value)?$value:0;
    }
    protected function getOkAttr($value){
        $ary=[0=>"未完结",1=>"已完结"];
        return $ary[$value];
    }
    protected function getTimeAttr($value){
        return date("Y-m-d h:i:s",$value);
    }
    protected function setTimeAttr(){
        return time();
    }
}