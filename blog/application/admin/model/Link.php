<?php
namespace app\admin\model;
use think\Model;
class Link extends Model
{
	// 关闭自动写入createTime字段
	protected $createTime = false;
	// 关闭自动写入update_time字段
	protected $updateTime = false;
}
