<?php
namespace app\index\controller;

use think\Controller;

class Index extends Common
{
	public function index()
	{
		$newArticle=db('article')->order('time desc')->field('a.*,b.sort_name')->alias('a')->join('sm_sort b','a.sortid=b.id')->paginate(8);
		$website=db('website')->select();
		$Banner1=db('banner')->where('id=1')->find();
		$Banner2=db('banner')->where('id=2')->find();
		$this->assign('newArticle',$newArticle);
		$this->assign('web',$website);
		$this->assign(array(
    		'newArticle'=>$newArticle,
            'web'=>$website,
            'banner1'=>$Banner1,
            'banner2'=>$Banner2,

    		));
		return view();
	}
}
