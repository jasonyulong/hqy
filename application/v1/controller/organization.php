<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/8/28
 * Time: 16:48
 */
namespace app\v1\controller;
use app\common\controller\AuthController;
use think\Config;
use app\v1\service\Organizations;
/**
 * @desc 组织架构的类
 * Class organization
 * @package app\v1\organization
 */
class organization extends AuthController
{

    /**
     * @DESC：组织架构首页
     * @author: jason
     * @date: 2019-08-28 04:53:13
     */
    public function index()
    {
        $list = Organizations::instance()->getOrgList();
//        echo '<pre>';print_r($list);exit;
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * @DESC：添加新成员
     * @author: jason
     * @date: 2019-08-29 08:45:04
     */
    public function addorg()
    {
        if($this->request->isPost() && $this->request->isAjax()){
            $request = $_POST['data'];
            parse_str($request,$post);
            $return_data = Organizations::instance()->add_org($post);
            return $return_data;
        }
        $data = Organizations::instance()->getUser();
        $all_org = Organizations::instance()->getAllOrg(2);
        $data = array_column($data,'username','id');
        $this->assign('all_org',$all_org);
        $this->assign('saleUser',$data);
        return $this->fetch();
    }
}