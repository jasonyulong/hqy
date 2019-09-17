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
class Goods extends Validate{
    protected $rule =   [
        'title'  => 'require|min:2|max:100',
        'titletype'  => 'require|number',
        'price'  => 'require|number',
        'pricetype'  => 'require|number',
        'address'  => 'require|max:500',
        'timeb'  => 'require',
        'timee'  => 'require',
        'des'  => 'require|max:5000',
    ];
    protected $field = [
        'title'  => '任务名称',
        'titletype'  => '任务类型',
        'price'  => '项目金额',
        'pricetype'  => '结算方式',
        'address'  => '工作地点',
        'timeb'  => '工作时间起',
        'timee'  => '工作时间止',
        'des'  => '详情',
    ];
    protected $scene = [
        'add'  =>  ['title','titletype','price','pricetype','address','timeb','timee','des'],
        'edit'  =>  ['title','titletype','price','pricetype','address','timeb','timee','des'],
    ];
}