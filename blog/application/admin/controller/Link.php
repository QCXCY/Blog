<?php
namespace app\admin\controller;

use app\admin\model\Link as LinkModel;

class Link extends Base
{
	public function link()
	{
		$linkes=db('link')->paginate(10);
		//$linkres=LinkModel::paginate(2);
		$this->assign('linkes',$linkes);
		return $this->fetch();
	}

	public function addlink(){
		if(request()->isPost()){
			$data=input('post.');
			//$add=db('link')->insert($data);
			$link=new LinkModel;
			if($link->save($data)){
				$this->success('添加友情链接成功！',url('link'));
			}else{
				$this->error('添加友情链接失败！');
			}
		}
		return view();
	}

	public function editlink(){
		if(request()->isPost()){
			$link=new LinkModel;	
			$save=$link->update(input('post.'));
			if($save){
				$this->success('修改链接成功！',url('link'));
			}else{
				$this->error('修改链接失败！');
			}
			return;
		}
		$linkes=LinkModel::find(input('id'));
		$this->assign('link',$linkes);
		return view();
	}

	public function del(){
		$del=LinkModel::destroy(input('id'));
		if($del){
			$this->success('删除链接成功！',url('link')); 
		}else{
			$this->error('删除链接失败！');
		}
	}
}