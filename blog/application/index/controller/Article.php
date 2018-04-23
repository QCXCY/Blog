<?php
namespace app\index\controller;

use think\Controller;

class Article extends Common
{
    public function index()
    {
    	$id=input('artid');
    	db('article')->where('id',$id)->setInc('click');
    	$Article=db('article')->field('a.*,b.sort_name')->alias('a')->join('sm_sort b','a.sortid=b.id')->find($id);
    	$Prev=db('article')->where('id','<',$id)->where('sortid','=',$Article['sortid'])->order('id desc')->limit(1)->value('id');
    	$Next=db('article')->where('id','>',$id)->where('sortid','=',$Article['sortid'])->order('id desc')->limit(1)->value('id');
    	$this->assign(array(
    		'article'=>$Article,
            'prev'=>$Prev,
            'next'=>$Next,
    		));
        return view('article');
    }
}
