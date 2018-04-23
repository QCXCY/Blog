<?php
namespace app\index\controller;
use think\Controller;
class Common extends Controller
{
	public function _initialize(){
		$this->nav();
		$this->linkRes();
		$this->hotArticle();
		$this->sortName();
		$this->Logo();
		$this->tags();
	}
	//导航栏
	public function nav(){
		$naves=db('sort')->order('sorting')->select();
		$this->assign('naves',$naves);
	}
	//友情链接
	public function linkRes(){
		$linkRes=db('link')->order('id')->select();
		$this->assign('linkRes',$linkRes);
	}
	//热门文章
	public function hotArticle(){
		$hotArticle=db('article')->order('click desc')->limit(8)->select();
		$this->assign('hotArticle',$hotArticle);
	}
	//文章分类
	public function sortName(){
		$sortName=db('sort')->field('sort_name')->find(input('sortid'));
		$this->assign('sortName',$sortName);
	}
	//搜索
	public function Search(){
		$Search=db('article')->order('time desc')->where('sortid','=',input('sortid'))->field('a.*,b.sort_name')->alias('a')->join('sm_sort b','a.sortid=b.id')->select();
		$this->assign('search',$Search);
	}
	//Logo
	public function Logo(){
		$Logo=db('logo')->select();
		$this->assign('logo',$Logo);
	}
	//标签云
	public function tags(){
		$tag=db('article')->field('a.*,b.sort_name')->alias('a')->join('sm_sort b','a.sortid=b.id')->select();
		$this->assign('tag',$tag);
	}
	
}
