<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class Goods extends Model
{
    protected $insert = ['goodsid','order_id','show','pay','suan'];
    protected $classname;
    function initialize(){
        $this->classname=explode('\\',__CLASS__);
        $this->classname=end($this->classname);
    }

    function add($data,$field=true){
        $data=initData($field,$data);
        #$data["show"]=1;
        $this->validate($this->classname.".".__FUNCTION__);
        $res = $this->allowField($field)->save($data);

        if( $res!==false && !empty($data["file"]) ){
            $lastid=$this->getLastSql();
            $ary=Filem::file_move($data["file"],$this->classname);
            if(!empty($ary)){
                foreach($ary as $v){
                    db("GoodsFile")->insert(["goods_id"=>$lastid,"url"=>$v]);
                }
            }
        }

        return $res;
    }

    function edit($data,$field=true){
        $data=initData($field,$data);
        $this->validate($this->classname.".".__FUNCTION__);
        $res=$this->allowField($field)->isUpdate()->save($data);

        if( $res!==false && !empty($data["file"]) ){
            $lastid=$data["id"];
            $ary=Filem::file_move($data["file"],$this->classname);
            if(!empty($ary)){
                foreach($ary as $v){
                    db("GoodsFile")->insert(["goods_id"=>$lastid,"url"=>$v]);
                }
            }
        }

        return $res;
    }

    function del($id){
        $info=$this->where(array('id'=>$id))->find();
        if(!empty($info["order_id"])){
            $this->error="已经选单不能删除";
            return false;
        }

        if($info["pay"]==1||$info["suan"]==1){
            $this->error="付款和结算的订单不能删除";
            return false;
        }

        $list=db("GoodsFile")->where(["goods_id"=>$info["id"]])->select();
        if(!empty($list)) {
            foreach ($list as $v) {
                Filem::file_del($v["url"]);
            }
        }
        db("GoodsFile")->where(["goods_id"=>$info["id"]])->delete();

        $res=$this->where(array('id'=>$info["id"]))->delete();

        db("GoodsOrder")->where(["goods_id"=>$info["id"]])->delete();

        return $res;
    }

    function delfile($id){
        $info=db("GoodsFile")->where(["goods_id"=>$id])->find();
        if($info) Filem::file_del($info["url"]);
        db("GoodsFile")->where(["goods_id"=>$id])->delete();
        return true;
    }

    protected function setGoodsidAttr(){
        return date("Ymd").rand(1111,9999);
    }
    protected function getTimebAttr($value){
        return date("Y-m-d h:i:s",$value);
    }
    protected function setTimebAttr($value){
        return strtotime($value);
    }
    protected function getTimeeAttr($value){
        return date("Y-m-d h:i:s",$value);
    }
    protected function setTimeeAttr($value){
        return strtotime($value);
    }
    protected function getShowAttr($value){
        $ary=[0=>"未审核",1=>"已审核"];
        return $ary[$value];
    }
    protected function getTitletypeAttr($value){
        $ary=[1=>"兼职",2=>"全职",3=>"其它"];
        return $ary[$value];
    }
    protected function getPricetypeAttr($value){
        $ary=[1=>"月结",2=>"日结",3=>"其它"];
        return $ary[$value];
    }
    protected function getPayAttr($value){
        $ary=[0=>"未支付",1=>"已经支付"];
        return $ary[$value];
    }
    protected function getSuanAttr($value){
        $ary=[0=>"未结算",1=>"已结算"];
        return $ary[$value];
    }
    protected function setOrderIdAttr($value){
        return isset($value)?$value:0;
    }
    protected function setShowAttr($value){
        return isset($value)?$value:0;
    }
    protected function setPayAttr($value){
        return isset($value)?$value:0;
    }
    protected function setSuanAttr($value){
        return isset($value)?$value:0;
    }
}