<?php
namespace app\admin\controller;

use app\admin\model\Article as ArticleModel;

class Article extends Base
{
	public function listing()
	{
		//循环输出、连表查询、分页
		$artres=db('article')->order('time desc')->field('a.*,b.sort_name')->alias('a')->join('sm_sort b','a.sortid=b.id')->paginate(20);
		$this->assign('artres',$artres);
		return $this->fetch();
	}
    //添加文章模块
	public function addarticle()
	{
		if(request()->isPost()){
			$data=input('post.');
			//模型处理数据
			$article= new ArticleModel;
			//上传功能                          
			// if($_FILES['plan']['tmp_name']){                     
			// 	$file = request()->file('plan');
			// 	$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			// 	if($info){
			// 		$plan='/smile/'. 'public' . DS . 'uploads'.'/'.$info->getSaveName();
			// 		$data['plan']=$plan;
			// 	}
			// }
			if ($article->save($data)) {
				return $this->success('添加文章成功！','listing');
			}else{
				return $this->error('添加文章失败！');
			}
			return;
		}
		$classi= \think\Db::name('sort')->select();              
		$this->assign('classi',$classi);                             
		return $this->fetch();
	}
    //修改文章模块
	public function editarticle()
	{
		if (request()->isPost()) {
			$article=new ArticleModel;
			$save=$article->update(input('post.'));
			if ($save) {
				$this->success('修改文章成功！',url('listing'));
			}else{
				$this->error('修改文章失败！');
			}
			return;
		}
		$classi= \think\Db::name('sort')->select();
		$art=db('article')->find(input('id'));
		$this->assign(array(
			'classi'=>$classi,
			'art'=>$art,
		));
		return $this->fetch();
	}
	public function del(){
		if (ArticleModel::destroy(input('id'))) {
				$this->success('删除文章成功！',url('listing'));
			}else{
				$this->error('删除文章失败！');
			}
			return;
	}
}
