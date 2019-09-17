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
class UserPerson extends Validate{
    protected $rule =   [
        'name'  => 'max:10',
        'code'  => 'max:20',
        'pic'  => 'max:40',
        'picf'  => 'max:40',
        'job'  => 'max:20',
        'jobname'  => 'max:20',
        'jtype'  => 'max:40',
        'jtime'  => 'max:60',
        'timelong'  => 'max:20',
        'jobarea'  => 'max:80',
        'jobaddress'  => 'max:40',
        'money'  => 'max:20',
        'des'  => 'max:500',
        'state'  => 'in:0,1',
    ];
    protected $field = [
        'name'  => '名字',
        'code'  => '身份证号码',
        'pic'  => '身份证正面',
        'picf'  => '身份证反面',
        'job'  => '职业状态1',
        'jobname'  => '职业状态2',
        'jtype'  => '工作时间类型',
        'jtime'  => '工作时间',
        'timelong'  => '每周工作时长',
        'jobarea'  => '工作区域',
        'jobaddress'  => '工作地点',
        'money'  => '日薪',
        'des'  => '个人介绍',
        'state'  => '状态',
    ];
    protected $scene = [
        'edit'  =>  ['name','code','pic','picf','job','jobname','jtype','jtime','timelong','jobarea','jobaddress','money','des','state'],
    ];
}