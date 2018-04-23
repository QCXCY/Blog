<?php
namespace app\admin\validate;

use think\Validate;

class Link extends Validate
{
	protected $rule = [
	'title'  =>  'require|max:10|unique:sort',
	];
	protected $message  =   [
	'title.require' => '分类名称不能为空',
	'title.max'     => '分类名称最多不能超过10个字符',  
	'title.unique'     => '分类名称不能重复',  
	];

}