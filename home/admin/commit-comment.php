<?php
/**
 * 提交评论
 * @param  string $country_name     乡村名字（必须与数据表里字段数据一样）
 * @param  string $content          评论内容
 * @param  int    $type             类型，1：父评论;2：子评论
 * @param  int    $parent_id        如果是子评论，那么这是父评论的id。如果是父评论，那么该值为0
 * @return json   
 */
	require('coon.php');
	require('getInformation.php');
	session_start();

	$username     = $_SESSION['username']; //用户名
	$country_name = $_POST['country_name'];
	$content      = $_POST['content'];
	$type         = $_POST['type'];
	$parent_id    = $_POST['parent_id'];

	if(!$username){
		echo '{"success":false,"msg":"还未登录"}';
		return;
	}

	$userid = getUseridByUsername($username);
	$countryid = getCountryidByCountryname($country_name);
	$time = date("Y-m-d H:i:s");

	if(!$countryid){
		echo '{"success":false,"msg":"乡村不存在"}';
		return;
	}

	if($type == 1){
		$check  = mysql_query("select * from country_comment where user_id='$userid' AND country_id='$countryid'");
		$result = mysql_fetch_assoc($check);
		if($result){                           //规定一个用户只能评论一次同一个地点
			echo '{"success":false,"msg":"您已评论过该乡村"}';
			return;
		}
		$insert = mysql_query("insert into country_comment(country_id,user_id,content,comment_time)values('$countryid','$userid','$content','$time')");
	}else if($type == 2){
		$insert = mysql_query("insert into country_comment(country_id,user_id,content,comment_time,parent_id)values('$countryid','$userid','$content','$time','$parent_id')");
	}else{
		return;
	}

	echo '{"success":true,"msg":"评论成功"}';
?>
