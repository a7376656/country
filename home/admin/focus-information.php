<?php
/**
 * 关注/粉丝具体信息表
 * @param  string $type     获取类型，focus--关注列表  fans--粉丝列表
 * @param  string $userid   用户id(不是用户名)
 * @param  type   post
 * @return json   $arr -- 对应users表里字段信息
 */
	require('coon.php');
	session_start();

	$userid = $_POST['userid'];
	$type   = $_POST['type'];
	$arr    = array(); //存储最终信息

	if($type == 'focus'){                                    //关注的人的信息
		$sql  = mysql_query("select * from focus where user_id='$userid'");
		$info = mysql_fetch_assoc($sql);

		if(!$info){
			echo '{"success":false,"msg":"还未有关注的人"}';
			return;
		}

		do{
			$id = $info['focus_id'];
			$check  = mysql_query("select * from users where id='$id'");
			$result = mysql_fetch_assoc($check);

			$arr[] = $result;
		}while($info = mysql_fetch_assoc($sql));

		$arr = json_encode($arr);

		echo '{"success":true,"msg":'.$arr.'}';
	}

    if($type == 'fans'){
		$sql  = mysql_query("select * from focus where focus_id='$userid'");
		$info = mysql_fetch_assoc($sql);

		if(!$info){
			echo '{"success":false,"msg":"还未有粉丝"}';
			return;
		}

		do{
			$id = $info['user_id'];
			$check  = mysql_query("select * from users where id='$id'");
			$result = mysql_fetch_assoc($check);

			$arr[] = $result;
		}while($info = mysql_fetch_assoc($sql));

		$arr = json_encode($arr);

		echo '{"success":true,"msg":'.$arr.'}';
    }

    /**
     * 获取关注/粉丝个人信息函数
     * @param  string $type 当前操作类型;关注/粉丝
     * @param  string $id   输出的类型;粉丝/关注
     * @return json   array $arr  
     */
 //    function getInformation($type, $id)   
 //    {
		
 //    }
?>
