<?php
/**
 * 处理用户修改个人信息
 * @param  string    $nickname     昵称
 * @param  string    $sex     	   性别
 * @param  string    $birthday     生日
 * @param  string    $address      地址
 * @param  string    $email        邮箱
 * @param  string    $signature    签名
 * @return json
 */
	require('coon.php');
	require('getInformation.php');
	session_start();

	$username  = $_SESSION['username'];
	$nickname  = $_POST['nickname'];
	$sex       = $_POST['sex'];
	$birthday  = $_POST['birthday'];
	$address   = $_POST['address'];
	$email     = $_POST['email'];
	$signature = $_POST['signature'];

	if(!$username){
		echo '{"success":false,"msg":"页面错误"}';
		return;	
	}

	if($sex == '男'){
		$sex = 1;
	}else{
		$sex = 2;
	}
	
	$sql = mysql_query("update users set nickname='$nickname',sex='$sex',birthday='$birthday',address='$address',email='$email',signature='$signature' where username='$username'"); //更新数据
	echo '{"success":true,"msg":"修改成功"}';
?>
