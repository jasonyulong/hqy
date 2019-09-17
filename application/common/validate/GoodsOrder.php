<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2018/3/22
 * Time: 9:35
 */

namespace app\common\validate;

use think\Validate;
/**
 * 设置模型
 */
class GoodsOrder extends Validate{
    protected $rule =   [
        'goods_id'  => 'require|number',
        'user_id'  => 'number',
        'msg'  => 'require',
        'price'  => 'number',
        'pay'  => 'in:0,1',
        'state'  => 'in:0,1',
    ];
    protected $field = [
        'goods_id'  => '项目ID',
        'user_id'  => '用户ID',
        'msg'  => '申请理由',
        'price'  => '分配金额',
        'pay'  => '支付状态',
        'state'  => '状态',
    ];
    protected $scene = [
        'add'  =>  ['goods_id','user_id','msg'],
    ];
}