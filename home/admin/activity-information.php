<?php
/**
 * 获取活动信息
 * @return json  $arr   通过$arr里的type进行判断属于那种类型活动，1为画册，2为视频
 */
	require('coon.php');

	$arr  = array(); //存储最终输出的信息

	$sql  = mysql_query("select * from activity");
	$info = mysql_fetch_assoc($sql);

	do{
		$arr[] = $info;
	}while($info=mysql_fetch_assoc($sql));

	$arr = json_encode($arr);

	echo '{"success":true,"msg":'.$arr.'}';
?>
