<?php
namespace app\index\Controller;

use app\index\Controller\Base;
// use think\Controller;
use think\Session;
use think\Db;

class Index extends Base
{
	public function index()
	{
		$admin_name = $this->request->session('admin_name');
		if(empty($admin_name)){
			$this->redirect('Login/index');
		}
		
		$user_id = Db::name('users')->where('username', $admin_name)->value('id');
		$role_id = Db::name('role_user')->where('user_id', $user_id)->value('role_id');
		$rules = Db::name('auth_access')->where('role_id', $role_id)->select();

		// print_r($rules);
		// return;
		$this->assign('info', $rules);
		return $this->fetch();
	}

	public function show()
	{
		return $this->fetch();
	}
}
