<?php
namespace app\index\Controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Request;

class Base extends Controller
{
	/**
	 * 检查用户登录
	 */
	protected function check_login()
	{
		$redirect=$_SERVER['HTTP_REFERER']; //判断前页面
		$user_name = $this->request->session('username');
		if(empty($user_name)){
			$this->error('您还没有登录',$redirect);
		}
	}
}
