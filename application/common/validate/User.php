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
class User extends Validate{
    protected $rule =   [
        'phone'  => 'require|number|unique:user|min:11|max:11',
        'password'  => 'min:4|max:20',
        'password2'  => 'confirm:password',
        'email'  => 'email',
        'usertype'  => 'in:0,1,2',
    ];
    protected $field = [
        'phone'  => '手机号',
        'password'  => '密码',
        'password2'  => '确认密码',
        'email'  => '电子邮件',
        'usertype'  => '用户类型',
    ];
    protected $scene = [
        'add'  =>  ['phone','password','password2','email','usertype'],
        'edit'  =>  ['email'],
    ];
}