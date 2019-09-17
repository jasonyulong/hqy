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
class UserGeti extends Validate{
    protected $rule =   [
        'name'  => 'max:50',
        'zhusuo'  => 'max:200',
        'jingying'  => 'max:200',
        'youbian'  => 'max:40',
        'shouji'  => 'max:20',
        'zhiben'  => 'max:20',
        'leixing'  => 'max:100',
        'hesuan'  => 'in:0,1',
        'renshu'  => 'max:10',
        'hangye'  => 'max:200',
        'fanwen'  => 'max:1000',
        'faren_name'  => 'max:100',
        'faren_code'  => 'max:100',
    ];
    protected $field = [
        'name'  => '名称',
        'zhusuo'  => '企业住所',
        'jingying'  => '经营地',
        'youbian'  => '邮编',
        'shouji'  => '联系电话',
        'zhiben'  => '注册资本',
        'leixing'  => '企业类型',
        'hesuan'  => '核算方式',
        'renshu'  => '从业人数',
        'hangye'  => '行业类型',
        'fanwen'  => '经营范围',
        'faren_name'  => '法人名字',
        'faren_code'  => '法人证件号码',
    ];
    protected $scene = [
        'edit'  =>  ['name','zhusuo','jingying','youbian','shouji','zhiben','leixing','hesuan','renshu','hangye','fanwen','faren_name','faren_code'],
    ];
}