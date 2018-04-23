<?php
namespace app\index\controller;

use think\Controller;

class Search extends Common
{
	public function index()
	{
		$keywords=input('keywords');
		$serArticle=db('article')->order('id desc')->field('a.*,b.sort_name')->alias('a')->join('sm_sort b','a.sortid=b.id')->where('title|des','like','%'.$keywords.'%')->paginate(8,false,$config = ['query'=>array('keywords'=>$keywords)]);
		$this->assign(array(
			'serArticle'=>$serArticle,
			'keywords'=>$keywords,
		));
		return view('search');
	}
}
