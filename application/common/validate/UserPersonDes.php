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
class UserPersonDes extends Validate{
    protected $rule =   [
        'user_id'  => 'require',
        'name'  => 'require',
        'type'  => 'require',
        'link'  => 'require',
        'key'  => 'require',
        'des'  => 'require',
        'z'  => 'require',
    ];
    protected $field = [
        'user_id'  => '用户ID',
        'name'  => '技能描述',
        'type'  => '工作类型',
        'link'  => '工作链接',
        'key'  => '关键功能',
        'z'  => '工作职责',
    ];
    protected $scene = [
        'edit'  =>  ['user_id','name','type','link','key','z'],
    ];
}