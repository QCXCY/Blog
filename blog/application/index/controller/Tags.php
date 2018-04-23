<?php
namespace app\index\controller;

use think\Controller;

class Tags extends Common
{
	public function index()
	{
		$tags=input('tags');
		$map['keywords'] = ['like','%'.$tags.'%'];
		$tagser=db('article')->order('time desc')->where($map)->field('a.*,b.sort_name')->alias('a')->join('sm_sort b','a.sortid=b.id')->paginate(8);
		$this->assign(array(
			'Tagser'=>$tagser,
			'tags'=>$tags,
			));
		return view('tags');
	}
}
