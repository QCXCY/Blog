<?php
namespace app\admin\controller;

use app\admin\model\About as AboutModel;

class About extends Base
{
	public function about()
	{
		//循环输出、连表查询、分页
		$About=db('about')->select(); 
		$this->assign('about',$About);
		return $this->fetch();
	}
    //添加模块
	public function addabout()
	{
		if(request()->isPost()){
			$data=input('post.');
			//模型处理数据
			$about= new AboutModel;
			if ($about->save($data)) {
				return $this->success('添加关于信息成功！','about');
			}else{
				return $this->error('添加关于信息失败！');
			}
			return;
		}              
		return $this->fetch();
	}
    //修改模块
	public function editabout()
	{
		if (request()->isPost()) {
			$about=new AboutModel;
			$save=$about->update(input('post.'));
			if ($save) {
				$this->success('修改关于信息成功！',url('about'));
			}else{
				$this->error('修改关于信息失败！');
			}
			return;
		}
		$About=AboutModel::find(input('id'));
		$this->assign('about',$About);
		return $this->fetch();
	}
	//删除
	public function del(){
		if (AboutModel::destroy(input('id'))) {
			$this->success('删除关于信息成功！',url('about'));
		}else{
			$this->error('删除关于信息失败！');
		}
		return;
	}
}
