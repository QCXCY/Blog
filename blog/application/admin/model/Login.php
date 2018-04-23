<?php
namespace app\admin\model;
use think\Model;

class Login extends Model
{
	public function login($username,$password){
		$admin= \think\Db::name('admin')->where('username','=',$username)->find();
		if($admin){
			if($admin['password']==md5($password)){
				\think\Session::set('id',$admin['id']);
                return 2; //登录密码正确的情况
            }else{
                return 3; //登录密码错误
            }
        }else{
            return 1; //用户不存在的情况
        }
    }
}
