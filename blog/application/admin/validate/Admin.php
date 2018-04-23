<?php
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
	protected $rule = [
	'use_name'  =>  'require|max:10|unique:sort',
	'password'  =>  'require',

	];
	protected $message  =   [
	'use_name.require' => '管理员名称不能为空',
	'use_name.max'     => '管理员名称最多不能超过10个字符',  
	'use_name.unique'     => '管理员名称不能重复',
	'password.require' => '密码不能为空',  
	];

}