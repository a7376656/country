<?php
/**
 * 用户信息(个人中心)
 * @param  string view_name 用户名,可选.如果要获取他人个人信息，则带上这个参数，如****.php?view_name=xxx;
 * @param  type   get
 * @return json -- 对应users表里字段信息
 */
	require('coon.php');
	session_start();

    $bool_view_others = false; //判断参数，如当前访问的是他人个人中心，则为true。否则默认访问自己个人中心，为false;

    if($_GET['view_name']){            //访问其他用户个人中心
        $username = $_GET['view_name'];
        if($username != $_SESSION['username'])
            $bool_view_others = true;
    }else{                             //访问自己个人中心
        $username = $_SESSION['username'];
    }

   
    if(!$username){
        echo '{"success":false,"msg":"还未登录"}';
        return;
    }

    $sql  = mysql_query("select * from users where username='$username'");
    $info = mysql_fetch_assoc($sql);

    if(!$info){
        echo '{"success":false,"msg":"用户名不存在"}';
        return;
    }

    /*
        此处为访问他人个人中心，此人浏览量+1
     */
    // if($bool_view_others && $_SESSION['username']){
    if($bool_view_others){
        $view_num = $info['view_num'];
        $view_num = $view_num+1;
       
       /*
            防止重复刷新，刷浏览人数
        */
        $time = time();
        if(!$_SESSION['view_user'] || $_SESSION['view_user']!=$username){             //如果还未访问过该用户
            $_SESSION['view_time'] = $time;
            $_SESSION['view_user'] = $username;
            $update = mysql_query("update users set view_num='$view_num' where username='$username'");
        }else{                                                                        //已访问过该用户
            $last_time = $_SESSION['view_time'];

            if($time - $last_time > 30){                                              //30秒后人数才能再次+1
                $update = mysql_query("update users set view_num='$view_num' where username='$username'");
                $_SESSION['view_time'] = $time;
                $_SESSION['view_user'] = $username;
            }
        }
    }


    $info = json_encode($info);
    echo $info;
?>
