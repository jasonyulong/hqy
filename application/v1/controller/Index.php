<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/7/24
 * Time: 17:04
 */
namespace app\v1\controller;
//use think\Controller;
use app\common\controller\AuthController;
use app\v1\service\Home;
use think\session;
class Index extends AuthController
{
    /**
     * @DESC：后台首页
     * @author: jason
     * @date: 2019-07-24 05:05:08
     */
    public function index()
    {
        $userInfo = Session::get();
        $userId = $userInfo['userid'];
        $data = Home::instance()->getData($userId);
//        echo '<pre>';print_r($data);exit;


        $this->assign('userInfo',$userInfo);
        return $this->fetch();
    }
}