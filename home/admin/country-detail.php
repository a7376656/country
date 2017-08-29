<?php
/**
 * 乡村/渔村具体信息
 * @param  string $country_name     乡村名字（必须与数据表里字段数据一样），如果为all,则代表所有乡村
 * @return json   $info 			乡村信息
 * @return int    $num 			    数量
 */
	require('coon.php');
	session_start();

	$country_name = $_GET['country_name'];
	$arr = array();

	if($country_name == 'all'){
		$sql = mysql_query("select * from country");
		$info = mysql_fetch_assoc($sql);
		$num = mysql_num_rows($sql);

		do{
			$arr[] = $info;
		}while($info=mysql_fetch_assoc($sql));
		$arr = json_encode($arr);
		echo '{"success":true,"num":'.$num.',"msg":'.$arr.'}';
	}else{
		$sql  = mysql_query("select * from country where name='$country_name'");
		$info = mysql_fetch_assoc($sql);

		if(!$info){
			echo '{"success":false,"msg":"请求错误，乡村不存在"}';
			return;
		}
		
		$info = json_encode($info);
		echo '{"success":true,"msg":'.$info.'}';
	}
	
?>
