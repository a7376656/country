<?php
/**
 * 判断用户是否登录
 * @return json
 */
	require('coon.php');
	session_start();

	$username = $_SESSION['username'];

	if(!$username){
		echo '{"success":false,"msg":"还没登录"}';
		return;
	}

	$sql  = mysql_query("select * from users where username='$username'");
	$info = mysql_fetch_assoc($sql);

	$info = json_encode($info);
	echo '{"success":true,"msg":'.$info.'}';
?>
