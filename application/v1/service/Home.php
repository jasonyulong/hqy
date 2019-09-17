<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/8/5
 * Time: 15:34
 */
namespace app\v1\service;

use think\Cache;
use think\Config;
use app\common\model\Menu;
use plugin\Crypt;
class Home
{
    protected static $instance = null;
    protected $_reids = null;

    /**
     * @DESC：单例
     * @return null|static
     * @author: jason
     * @date: 2019-08-05 03:48:37
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




    public function getData($uid)
    {
        return $this->_reids->handler()->hget(Config::get('redis.user_token'),$uid);
    }

    public function setData()
    {
        $total = Menu::instance()->where(['status' => 1])->count();
        $limit = 100;
        $start = 0;
        $orderKey = 'orders:ebay_id:cache:platform:all';
        while ($start < $total) {
            $arr = collection(Menu::instance()->where(['status' => 1])->limit($start, $limit)->select())->toArray();
            $arr = array_filter($arr, function ($params) {
                return !empty($params);
            });
            $list = array_column($arr, 'title', 'id');
            foreach ($list as $key => $value) {
                $this->_reids->handler()->RPUSH($orderKey,$value);
                echo sprintf("push menu %s <br>",$value);
            }
            $start += $limit;
        }
    }

}