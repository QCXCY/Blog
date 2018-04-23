<?php
namespace app\admin\controller;

use app\admin\model\Website as WebsiteModel;
use app\admin\model\Logo as LogoModel;

class Website extends Base
{
	public function Website()
	{
		$website=db('website')->select();
		$logo=db('logo')->select();
		$this->assign(array(
			'webs'=>$website,
			'lo'=>$logo,
		));
		return $this->fetch();
	}

	//添加功能
	// public function addwebsite(){
	// 	if(request()->isPost()){
	// 		$data=input('post.');
	// 		$website=new WebsiteModel;
	// 		if($website->save($data)){
	// 			$this->success('添加网站信息成功！',url('website'));
	// 		}else{
	// 			$this->error('添加网站信息失败！');
	// 		}
	// 	}
	// 	return view();
	// }

	//修改功能
	public function editwebsite(){
		if(request()->isPost()){
			$website=new WebsiteModel;	
			$save=$website->update(input('post.'));
			if($save){
				$this->success('修改网站信息成功！',url('website'));
			}else{
				$this->error('修改网站信息失败！');
			}
			return;
		}
		$website=WebsiteModel::find(input('id'));
		$this->assign('webs',$website);
		return view();
	}

	//添加Logo
	public function addlogo(){
		if(request()->isPost()){
			$data=input('post.');
			//模型处理数据
			$logo= new LogoModel;
			if($logo->save($data)){
				$this->success('添加logo成功！',url('website'));
			}else{
				$this->error('添加logo失败！');
			}
		}
		return view();
	}

	//Logo删除
	public function del(){
		$del=LogoModel::destroy(input('id'));
		if($del){
			$this->success('删除Logo成功！',url('website')); 
		}else{
			$this->error('删除Logo失败！');
		}
	}
}