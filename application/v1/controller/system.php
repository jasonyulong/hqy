<?php
/**
 * 系统管理.
 * User: abc
 * Date: 2019/7/25
 * Time: 14:06
 */
namespace app\v1\controller;
use app\common\controller\AuthController;
use app\v1\service\Systems;
use think\Config;
class system extends AuthController
{
    /**
     * @DESC：菜单管理列表
     * @author: jason
     * @date: 2019-07-25 02:07:22
     */
    public function menu()
    {
        //配置
        $status = Config::get('layout.status');
        $type = Config::get('layout.type');
        $params = request()->param();
        //菜单列表
        $list = Systems::instance()->menu($params);
        $menuListInfo = Systems::instance()->getMenuTree();
        $menuList = array_column($menuListInfo,'title','id');
        $this->assign('menuList',$menuList);
        $this->assign('status',$status);
        $this->assign('type',$type);
        $this->assign('data',$list['list']['data']);
        $this->assign('page',$list['page']);
        return $this->fetch();
    }

    /**
     * @DESC：添加菜单页面
     * @return mixed
     * @author: jason
     * @date: 2019-08-28 02:48:15
     */
    public function addmenu()
    {
        return $this->fetch();
    }

    /**
     * @DESC：添加或更新菜单
     * @author: jason
     * @date: 2019-08-28 02:48:38
     */
    public function savemenu()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            $params = $_POST['data'];
            parse_str($params,$post);
            $return_data = Systems::instance()->savemenu($post);
            return $return_data;
        }
    }


}