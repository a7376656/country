<?php
/**
 * 通过用户名获取用户id
 * @param  string  $username      用户名
 * @return int     $info['id'] 	  用户id
 */
	require('noheader-coon.php');

	function getUseridByUsername($username)
	{
		$sql  = mysql_query("select * from users where username='$username'");
		$info = mysql_fetch_assoc($sql);

		return $info['id']; 
	}

	function getCountryidByCountryname($countryname)
	{
		$sql  = mysql_query("select * from country where name='$countryname'");
		$info = mysql_fetch_assoc($sql);

		return $info['id']; 
	}
?>
