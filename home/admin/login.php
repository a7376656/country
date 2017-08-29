<?php
/**
 * 登录验证
 * @param  string $username 用户名
 * @param  string $password 密码
 * @param  type   post
 * @return json
 */
	require('coon.php');
	session_start();

    $username = $_POST['username'];
	$password = md5($_POST['password']);

    $sql  = mysql_query("select * from users where username='$username'");
    $info = mysql_fetch_assoc($sql);

    if(!$info){
    	echo '{"success":false,"msg":"用户名不存在"}';
    	return;
    }else if($info['password'] != $password){
    	echo '{"success":false,"msg":"密码错误"}';
    	return;
    }else{
		/************************设置cookie和session******************/
        $_SESSION['username']=$info['username'];
        // $_SESSION['password']=$info['password'];
        setcookie('username',$info['username'],time()+(60*60*24*30));
        setcookie('password',$info['password'],time()+(60*60*24*30));
		/************************更新上次登录时间*********************/
		$nowtime = date("Y-m-d H:i:s");
		$update = mysql_query("update users set last_login_time='$nowtime' where username='$username'");
		// $update = mysql_query("update tb_goods set view_num='$view_num' where id='$g_id'");//执行更新商品浏览数操作

        echo '{"success":true,"msg":"登录成功"}';
	}
?>
