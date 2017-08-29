<?php
/**
 * 退出登录
 * @return json
 */
	require('coon.php');
	session_start();

	$username = $_SESSION['username'];
	// $password=$_SESSION['password'];
	session_unset($username);//删除session
	// session_unset($password);

	setcookie("username","",time()-3600);//删除cookie
	setcookie("password","",time()-3600);

	echo '{"success":true,"msg":"退出登录成功"}'
?>