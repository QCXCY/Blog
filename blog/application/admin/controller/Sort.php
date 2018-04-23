<?php
namespace app\admin\controller;

use app\admin\model\Sort as SortModel;

class Sort extends Base
{
	protected $beforeActionList = [
		'delsonsort' =>  ['only'=>'del'],
	];

	public function Sort()
	{
		$sort=new SortModel();
		//更新排序
		if(request()-> isPost()){
			$data=input('post.');
			foreach ($data as $k => $v) {
				$sort->update(['id'=>$k,'sorting'=>$v]);
			}
			$this->success('更新排序成功！',url('sort'));
			return;
		}
		$Sort=$sort->sorttree();
		$this->assign('sort',$Sort);                   
		return view();
	}
	
	//栏目添加模块
	public function addSort()
	{
		$sort=new SortModel();
		if(request()-> isPost()) {
			$data=input('post.');
			if($sort->save($data)){
				$this->success('添加栏目成功！',url('sort'));
			}else{
				$this->error('添加栏目失败！');
			}
		}
		$sorts=$sort->sorttree();
		$this->assign('sorts',$sorts);
		return view();
	}

	//删除功能
	public function del(){
		$id=input('id');
		if (db('sort')->delete($id)) {
			return $this->success('删除成功！','Sort');
		}else{
			return $this->error('删除失败！');
		}
	}

	//删除子栏目处理
	public function delsonsort(){
		$sortid=input('id');      //要删除的当前栏目id
		$sort=new SortModel;
		$sonids=$sort->getchilrenid($sortid);
		if ($sonids) {
			db('sort')->delete($sonids);
		}
	}

	//修改模块
	public function editSort(){
		$sort=new SortModel();
		if(request()->isPost()){
			$save=$sort->update(input('post.'));
			if($save){
				$this->success('修改栏目成功！',url('sort'));
			}else{
				$this->error('修改栏目失败！');
			}
			return;
		}
		$sortid=$sort->find(input('id')); 
		$sorts=$sort->sorttree();
		$this->assign(array(
			'sortid'=>$sortid,
			'sorts'=>$sorts,
		));
		return view();
	}

}
