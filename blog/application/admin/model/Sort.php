<?php
namespace app\admin\model;
use think\Model;
class Sort extends Model
{
	// 关闭自动写入createTime字段
	protected $createTime = false;
	// 关闭自动写入update_time字段
	protected $updateTime = false;

	public function sorttree(){
		$sorter=$this->order('sorting')->select();
		return $this->sor($sorter);

	}

	public function sor($data,$lid=0,$level=0){
		static $arr=array();
		foreach ($data as $k => $v) {
			if ($v['lid']==$lid) {
				$v['level']=$level;
				$arr[]=$v;
				$this->sor($data,$v['id'],$level+1);
			}
		}
		return $arr;
	}

	//栏目删除处理
	public function getchilrenid($sortid){
		$sorters=$this->select();
		return $this->_getchilrenid($sorters,$sortid);
	}

	public function _getchilrenid($sorters,$sortid){
		static $arr=array();
		foreach ($sorters as $k => $v) {
			if ($v['lid'] == $sortid) {
				$arr[]=$v['id'];
				$this->_getchilrenid($sorters,$v['id']);
			}
		}
		return $arr;
	}
}
