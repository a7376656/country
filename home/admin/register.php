<?php
/**
 * 注册验证
 * @param  string $username  用户名
 * @param  string $password  密码
 * @param  string $password2 再次输入的密码
 * @param  type   post
 * @return json
 */
	require('coon.php');
	session_start();

	$username   = $_POST['username'];
	$password   = md5($_POST['password']);
    $password2  = md5($_POST['password2']);
    $createtime = date("Y-m-d H:i:s"); //当前时间

    $sql  = mysql_query("select * from users where username='$username'");
    $info = mysql_fetch_assoc($sql);

    if($info){
    	echo '{"success":false,"msg":"用户名已存在"}';
    	return;
    }else if($password != $password2){
    	echo '{"success":false,"msg":"两次密码输入不一样"}'; //不过这个应该前台js判断
    	return;
    }else{
        $nickname = '用户'.$username;
        $sql = mysql_query("insert into users(username,password,nickname,avatar,last_login_time,create_time)values('$username','$password','$nickname','initial.jpg','$createtime','$createtime')"); //执行插入操作

		/************************设置cookie和session******************/
        $_SESSION['username']=$info['username'];
        // $_SESSION['password']=$info['password'];
        setcookie('username',$info['username'],time()+(60*60*24*30));
        setcookie('password',$info['password'],time()+(60*60*24*30));

        echo '{"success":true,"msg":"注册成功"}';
	}
?>
