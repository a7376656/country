<?php
/**
 * 数据库连接配置,带header
 */
	header("Content-type:application/json;charset=utf-8");

	$coon=mysql_connect("localhost","root","root") or die("数据库连接失败".mysql_error());
	mysql_select_db("country");
	mysql_query("set names utf8");
?>
