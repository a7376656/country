<?php
namespace app\index\Controller;

use app\index\Controller\Base;
use think\Db;
use think\Session;

class User extends Base
{
	protected $pageSize = 5; //每页显示数量

	/**
	 * 处理分页
	 * @param  int  $nowPage      当前页数
	 * @param  char $table        需要查询的数据表
	 * @return [array] [所有该页数据信息]
	 */
	protected function paginate($nowPage, $table, $type)
	{
		$pageSize = $this->pageSize;
		
		$data = Db::name($table)->order('id',"desc")->select();
		$total = count($data); //数据总量
		$size = ceil($total/$pageSize); //总页数
		$now=($nowPage-1)*$pageSize; //当前的第一条数据

		$info = Db::name($table)->limit($now, $pageSize)->order('id desc')->select();
		return $info;
	}

	/**
	 * 获取分页总页数
	 * @param  char $table        需要查询的数据表
	 * @return int  $size 		  总页数
	 */
	protected function getSize($table) //获取总页数
	{
		$pageSize = $this->pageSize;
		$result = Db::name($table)->order('id desc')->select();
		$total = count($result); //数据总量
		$size = ceil($total/$pageSize);

		return $size;
	}

	public function initUserSize() //初始化User管理分页条
	{
		$size = $this->getSize('users');

		$size = json_encode($size);
		echo '{"success":true,"size":'.$size.'}';
		return;
	}

	public function index() //用户管理
	{
		$pageSize = $this->pageSize;
		$nowPage = input('get.page'); //当前页数
		if(!$nowPage)
			$nowPage=1;
		$data = Db::name('users')->order('id',"desc")->select();
		$total = count($data); //数据总量
		if($total <= $pageSize){
			$this->assign('info', $data);
			return $this->fetch();
		}else{
			$info = $this->paginate($nowPage, 'users', 1);
			$this->assign('info', $info);
			return $this->fetch();
		}
	}

	public function admin() //管理员管理
	{
		$admin_name = $this->request->session('admin_name');
		$data = Db::name('users')->where('type',0)->order('id',"desc")->select();
		$this->assign('info', $data);
		$this->assign('admin_name', $admin_name);
		return $this->fetch();
	}

	public function rbac() //角色管理
	{
		$roles = Db::name('role')->order("id desc")->select();
		$this->assign('roles', $roles);

		return $this->fetch();
	}

	public function editRbac() //角色修改
	{
		$role_id = input('post.role_id');
		$rolename = input('post.rolename');
		$remark = input('post.remark');
		$status = input('post.status');
		$updata_time = date("Y-m-d H:i:s");

		if($role_id!=null && $rolename!=null && $remark!=null && $status!=null)
		{
			$result = Db::name('role')->where('id', $role_id)->update(['name'=>$rolename, 'remark'=>$remark, 'status'=>$status, 'updata_time'=>$updata_time]);

			echo '{"success":true,"msg":"保存成功"}';
		}
	}

	public function addRbac() //增加角色
	{
		$rolename = input('post.rolename');
		$remark = input('post.remark');
		$status = input('post.status');
		$createtime = date("Y-m-d H:i:s");

		if($rolename!=null && $remark!=null && $status!=null)
		{
			$result = Db::name('role')->insert(['name'=>$rolename, 'remark'=>$remark, 'status'=>$status, 'create_time'=>$createtime, 'updata_time'=>$createtime, 'listorder'=>1]);

			echo '{"success":true,"msg":"保存成功"}';
		}
	}

	public function rootSet() //权限设置
	{
		$roots=[];

		$role_id = input('post.role_id');
		$roots = $_POST['roots'];

		if($role_id!=null && $roots!=null){
			$result1 = Db::name('auth_access')->where('role_id', $role_id)->delete();

			foreach ($roots as $v) {
				$result = Db::name('auth_access')->insert(['role_id'=>$role_id, 'rule_name'=>$v, 'type'=>'admin_url']);
			}

			echo '{"success":true,"msg":"保存成功"}';
		}
	}

	public function blackUser() //拉黑用户
	{
		$user_id = input('post.user_id');
		if(!$user_id){
			$this->error('请求错误','index/Index/index');
		}
		$info = Db::name('users')->where('id', $user_id)->find();

		if($info['type']==0 || $info['status']==0){
			echo '{"success":false,"msg":"用户拉黑失败！用户不存在，或者是管理员"}';
			return;
		}

		$update = Db::name('users')->where('id', $user_id)->update(['status'=>0]);
		echo '{"success":true,"msg":"拉黑成功"}';
	}

	public function onUser() //启用用户
	{
		$user_id = input('post.user_id');
		if(!$user_id){
			$this->error('请求错误','index/Index/index');
		}
		$info = Db::name('users')->where('id', $user_id)->find();

		if($info['type']==0 || $info['status']==1){
			echo '{"success":false,"msg":"用户启用失败"}';
			return;
		}

		$update = Db::name('users')->where('id', $user_id)->update(['status'=>1]);
		echo '{"success":true,"msg":"用户启用成功"}';
	}
}
