<?php
namespace app\admin\controller;

use app\admin\model\Banner as BannerModel;

class Banner extends Base
{
	public function banner()
	{
		//循环输出分类
		$Banner=db('banner')->select();
		$this->assign('banner',$Banner);                   
		return $this->fetch();
	}
	
	//添加功能
	public function addbanner(){
		if(request()->isPost()){
			$data=input('post.');
			//模型处理数据
			$banner= new BannerModel;
			if($banner->save($data)){
				$this->success('添加Banner图成功！',url('banner'));
			}else{
				$this->error('添加Banner图失败！');
			}
		}
		return view();
	}

	//删除功能
	public function del(){
		$del=BannerModel::destroy(input('id'));
		if($del){
			$this->success('删除Banner图成功！',url('banner')); 
		}else{
			$this->error('删除Banner图失败！');
		}
	}
	
}
