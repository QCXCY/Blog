<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Login as LoginModel;

class Login extends Controller
{
	public function Login()
	{
        if(request()->isPost()){
            $this->check(input('code'));
        	$login=new LoginModel;
        	$num=$login->login(input('username'),input('password'));
        	if($num==1){
        		$this->error('用户不存在！');
        	}
        	if($num==2){
        		$this->success('登录成功！',url('admin/Index/index'));
        	}
        	if($num==3){
        		$this->error('密码错误！');
        	}
        	return;
        }
        return view();
    }

    public function check($code='')
    {
        $captcha =new \think\captcha\Captcha();
        if (!$captcha->check($code)) {
            $this->error('验证码错误');
        }else{
            return true;
        }
    }


    public function logout(){
        session(null);
        $this->success('退出成功！',url('login'));
    }
}