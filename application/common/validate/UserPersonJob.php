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
class UserPersonJob extends Validate{
    protected $rule =   [
        'user_id'  => 'require',
        'begin'  => 'require|number',
        'end'  => 'require|number',
        'company'  => 'require|max:100',
        'job'  => 'require|max:100',
        'des'  => 'require',
    ];
    protected $field = [
        'user_id'  => '用户编号',
        'begin'  => '开始时间',
        'end'  => '结束时间',
        'company'  => '公司名称',
        'job'  => '职位名称',
        'des'  => '介绍',
    ];
    protected $scene = [
        'edit'  =>  ['user_id','begin','end','company','job','des'],
    ];
}