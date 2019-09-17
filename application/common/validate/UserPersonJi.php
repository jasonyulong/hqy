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
class UserPersonJi extends Validate{
    protected $rule =   [
        'user_id'  => 'require',
        'name'  => 'require',
        'fen'  => 'require',
    ];
    protected $field = [
        'user_id'  => '用户ID',
        'name'  => '技能描述',
        'fen'  => '评分',
    ];
    protected $scene = [
        'edit'  =>  ['user_id','name','fen'],
    ];
}