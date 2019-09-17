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
class UserCompany extends Validate{
    protected $rule =   [
        'name'  => 'require|max:50',
        'type'  => 'require|max:80',
        'pic'  => 'max:50',
        'pro'  => 'require',
        'city'  => 'require',
        'address'  => 'require|max:200',
        'year'  => 'require|max:20',
        'faren_name'  => 'require|max:50',
        'faren_z'  => 'require',
        'faren_f'  => 'require',
        'state'  => 'in:0,1',
    ];
    protected $field = [
        'name'  => '公司名称',
        'type'  => '行业',
        'pic'  => '营业执照',
        'pro'  => '省',
        'city'  => '市',
        'address'  => '常用地址',
        'year'  => '从业年限',
        'faren_name'  => '法人名字',
        'faren_z'  => '法人身份证正',
        'faren_f'  => '法人身份证反',
        'state'  => '状态',
    ];
    protected $scene = [
        'edit'  =>  ['name','pic','state'],
    ];
}