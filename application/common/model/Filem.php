<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/20
 * Time: 14:22
 */

namespace app\common\model;

use think\Model;

class Filem extends Model
{
    static function file_add($file,$dir,$ext,$size=1024*1024*4){
        if(!empty($file)){
            $file->rule("uniqid");
            $file->validate(['size' =>$size, 'ext' => $ext]);   //2M
            $info = $file->move(ROOT_PATH . 'layout' . DS .$dir);
            if ($info) {
                $uname=$dir . $info->getSaveName();
                db("filem")->insert(["url"=>$uname,"time"=>time()]);
                return db("filem")->where(["url"=>$uname])->find();
            } else {
                return $file->getError();
            }
        }else{
            return '未知原因';
        }
    }

    static function file_del($fileurl){
        $fileurl='.'.$fileurl;
        if(strlen($fileurl)>4&&file_exists($fileurl)){
            @unlink($fileurl);
        }
    }

    static function file_move($str,$rep){
        $nd=array();
        $exts=explode(",",$str);
        if($exts){
            foreach($exts as $v){
                $t=db("filem")->where(["id"=>$v])->find();
                if($t){
                    if(file_exists($t["url"])){
                        $newfile=str_replace("tmp",$rep,$t["url"]);
                        if(copy($t["url"],$newfile)){
                            $nd[]=$newfile;
                            db("filem")->where(["id"=>$v])->delete();
                        }
                    }
                }
            }
        }
        return $nd;
    }
}