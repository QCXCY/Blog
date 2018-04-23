<?php
namespace app\admin\controller;

class Admin extends Base
{
	public function admin()
	{
		$admi=db('admin')->select();
		$this->assign('admi',$admi);
		return $this->fetch();
	}

	//添加功能
	public function addadmin()
	{
		if(request()->isPost()){
			$data=[
				'username'=>input('username'),
				'password'=>MD5 (input('password')),
			];
			$db=db('admin')->insert($data);
			if($db){
				$this->success('添加管理员成功！',url('admin'));
			}else{
				$this->error('添加管理员失败！');
			}
		}
		return view();
	}

	//修改功能
	public function editadmin()
	{
		if (request()->isPost()) {
			$data=[
				'id'=>input('id'),
				'username'=>input('username'),
				'password'=>MD5 (input('password')),
			];
			$db=db('admin')->update($data);
			if ($db) {
				return $this->success('修改分类成功！','admin');
			}else{
				return $this->error('修改分类失败！');
			}
			return;
		}
		$id=input('id');
		$adm=db('admin')->where('id',$id)->find();
		$this->assign('adm',$adm);
		return $this->fetch();
	}

    //删除功能
	public function del(){
		$id=input('id');
		if (db('admin')->delete($id)) {
			return $this->success('删除成功！','admin');
		}else{
			return $this->error('删除失败！');
		}
	}

	//登录功能
	public function login(){
		return $this->fetch();
	}

}
