<?php
namespace app\index\controller;

use think\Controller;

class Archives extends Common
{
	public function index()
	{
		// $sortm=db('sort')->field('sort_name')->find(input('sortid'));
		$classArticle=db('article')->order('time desc')->where('sortid','=',input('sortid'))->field('a.*,b.sort_name')->alias('a')->join('sm_sort b','a.sortid=b.id')->paginate(8);
		$this->assign('classArticle',$classArticle);
		// $this->assign('sortm',$sortm);
		return view('archives');
	}
}
