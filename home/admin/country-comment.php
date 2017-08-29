<?php
/**
 * 乡村/渔村评论
 * @param  string $country_name     乡村名字（必须与数据表里字段数据一样）
 * @return json   $arr 			    乡村信息
 */
	require('coon.php');
	require('getInformation.php');
	session_start();

	$country_name = $_GET['country_name'];

	$country_id = getCountryidByCountryname($country_name);

	if(!$country_id){
		echo '{"success":false,"msg":"请求错误，乡村不存在"}';
		return;
	}

	$sql  = mysql_query("select * from country_comment where country_id='$country_id' AND parent_id=0 order by comment_time desc");
	$info = mysql_fetch_assoc($sql);

	if(!$info){
		echo '{"success":false,"msg":"还未有评论"}';
		return;
	}

	$arr = array(); //存储最后输出信息，包括评论信息以及用户个人信息
	$brr = array(); //存储子评论信息，包括评论信息以及用户个人信息

	do{
		$user_id = $info['user_id'];

		$check  = mysql_query("select * from users where id='$user_id'"); //查找这条评论作者个人信息
		$result = mysql_fetch_assoc($check);

		if($result['nickname'])
			$info['nickname'] = $result['nickname'];
		else
			$info['nickname'] = '渔村用户';

		$info['avatar']    = $result['avatar'];
		$info['focus_num'] = $result['focus_num'];
		$info['fans_num']  = $result['fans_num'];

		$id = $info['id'];
		$find = mysql_query("select * from country_comment where parent_id='$id' order by comment_time desc"); //查找这条评论是否有子评论
		$is_child = mysql_fetch_assoc($find);

		if($is_child){
			do{
				$child_user_id = $is_child['user_id'];

				$check2  = mysql_query("select * from users where id='$child_user_id'"); //查找这条评论作者个人信息
				$result2 = mysql_fetch_assoc($check2);

				if($result2['nickname'])
					$is_child['nickname'] = $result2['nickname'];
				else
					$is_child['nickname'] = '渔村用户';

				$is_child['avatar']    = $result2['avatar']; //用户头像
				$is_child['focus_num'] = $result2['focus_num']; //用户关注的人的数量
				$is_child['fans_num']  = $result2['fans_num']; //用户粉丝数量

				$brr[] = $is_child; //子评论信息
			}while($is_child=mysql_fetch_assoc($find));

			$info['children'] = $brr; 
		}else{
			$info['children'] = null; 
		}

		$arr[] = $info;
	}while($info=mysql_fetch_assoc($sql));

	$arr = json_encode($arr);
	echo '{"success":true,"msg":'.$arr.'}';
?>
