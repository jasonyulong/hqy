<?php
/**
 * Class System   系统配置类
 * @package app\v1\service
 */
namespace app\v1\service;

use app\common\model\Menu;
use app\common\model\Admin;
use think\session;
use plugin\Tree;
use plugin\Crypt;
use think\Cache;
use think\Config;
class Systems
{
    // 静态对象
    protected static $instance = null;
    protected $_reids = null;
    /**
     * @DESC：单例
     * @return null|static
     * @author: jason
     * @date: 2019-07-26 10:00:16
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * @DESC：初始化
     * @author: jason
     * @date: 2019-08-05 03:48:18
     */
    public function __construct()
    {
        $this->_reids = Cache::init(Config::get('cache.redis'));
    }

    /**
     * @DESC：生成token
     * @author: jason
     * @date: 2019-08-07 03:43:31
     */
    public function setToken($params)
    {
        return Crypt::encrypt($params);
    }

    /**
     * @DESC：检查是否有登录
     * @param $username
     * @param $password
     * @author: jason
     * @date: 2019-07-26 04:34:49
     */
    public function checklogin($username,$password)
    {
        $password = md5(md5($password));
        $user_info = Admin::where(['username' => $username,'is_del' => 0])->find()->toArray();
        if($username != $user_info['username'] || $password != $user_info['password']){
            return false;
        }
        $arr = [
            'id' => $user_info['id'],
            'username' => $user_info['username'],
        ];
        $token = $user_info['token'];
        $cache_token = $this->setToken($arr);
        if($token != $cache_token){
            return false;
        }
        //存入session
        Session::set('userid',$user_info['id']);
        Session::set('username',$user_info['username']);
        Session::set('truename',$user_info['truename']);
        Session::set('tel',$user_info['tel']);
        Session::set('power',$user_info['power']);
        Session::set('admin',$user_info['admin']);

        return true;
    }

    /**
     * @DESC：菜单
     * @author: jason
     * @date: 2019-07-26 09:58:40
     */
    public function menu($params)
    {
        //每页显示的数量
        $page_size = !empty($params['ps']) ? $params['ps'] : 20;
        //当前页
        $current_page = (!empty($params['page']) && intval($params['page']) > 0) ? $params['page'] : 1;
        //分页起始值
        $start = $page_size * ($current_page - 1);
        $fields = 'id,type,pid,title,url,icon,url,weigh,status,createtime,remark';
        $where['status'] = 1;
        //分页url参数
        $config = [
            'query' => request()->param(),
        ];
        $menuInfo = Menu::instance()->where($where)
            ->limit($start,$page_size)
            ->order('weigh', 'desc')
            ->field($fields)
            ->paginate($page_size, false, $config);
        $page = $menuInfo->render();
        $return_data = [
            'list' => $menuInfo->toArray(),
            'page' => $page,
        ];
        return $return_data;
    }



    /**
     * @DESC：修改密码
     * @author: jason
     * @date: 2019-07-29 02:38:01
     */
    public function changepass($params)
    {
        $uid = $params['uid'];
        $password = $params['password'];
        $password = md5(md5($password));
        $where['id'] = $uid;
        $res = Admin::where($where)->update(['password' => $password]);
        if($res === false){
            return false;
        }
        return true;
    }

    /**
     * @DESC：树形结构
     * @author: jason
     * @date: 2019-08-02 04:10:03
     */
    public function getMenuTree()
    {
        //查询出所有的菜单
        $menuInfo = collection(Menu::order('weigh', 'desc')->select())->toArray();
        Tree::instance()->init($menuInfo);
        $treeList = Tree::instance()->getTreeList(Tree::instance()->getTreeArray(0),'title');
        return $treeList;
    }

    /**
     * @DESC：
     * @author: jason
     * @date: 2019-08-28 02:47:03
     */
    public function savemenu($params)
    {
        $add['title'] = $params['title'];
        $add['type'] = $params['type'];
        $add['status'] = $params['status'];
        $add['url'] = $params['url'];
        $add['icon'] = $params['icon'];
        $add['remark'] = $params['remark'];
        $add['createtime'] = time();
        $res = Menu::instance()->insert($add);
        if($res === false){
            return json(['status' => false,'msg' => '操作失败']);
        }
        return json(['status' => true,'msg' => '操作成功']);
    }

}