<?php
namespace app\index\Controller;

use app\index\Controller\Base;
// use think\Controller;
use think\Session;
use think\Db;

class Login extends Base
{
	public function index() //登录页面
	{
		return $this->fetch();
	}

	public function do_login() //后台登录验证
	{
		$username = input('post.username');
		$password = md5(input('post.password'));

		if(!$username || !$password){
			$this->error('请求错误','index');
			return;
		}

		$check = Db::name('users')->where('username', $username)->where('type',0)->find();
		if(!$check){
			echo '<script>alert("用户名不存在或已被拉黑");history.go(-1);</script>';
			return;
		}
		if($check['password'] != $password){
			echo '<script>alert("密码错误");history.go(-1);</script>';
			return;
		}
		if($check['status'] == 0){
			echo '<script>alert("用户名不存在或已被拉黑");history.go(-1);</script>';
			return;
		}
		Session::set('admin_name', $username); //admin_name
		/*     role_type 	*/
		$this->redirect('index/Index/index');
	}	

	public function checkLogin() //检测登录
	{
		$result = $this->request->session('admin_name');
		if(!$result){
			$this->redirect('index');
		}
	}
 
	public function nav_login() //导航显示登录状态
	{
		$result = $this->request->session('admin_name');
		if(!$result){
			$this->redirect('index');
		}

		$result = json_encode($result);
		echo '{"success":true,"msg":'.$result.'}';
	}

	public function logout() //退出登录
	{
		Session::set('admin_name', null);

		$this->redirect('index');
	}
}
