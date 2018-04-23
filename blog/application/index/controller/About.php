<?php
namespace app\index\controller;

use think\Controller;

class About extends Common
{
    public function index()
    {
		$About=db('about')->select();
		$this->assign('about',$About);
        return view('about');
    }
}
