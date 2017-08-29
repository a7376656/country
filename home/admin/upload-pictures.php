<?php
/**
 * 上传画册
 * @param  string    $name          画册名称
 * @param  string    $intro         画册描述
 * @param  string    $username      用户名
 * @param  date      $create_time   游玩时间
 * @param  string    $create_place  地点
 * @param  string    $create_price  花费
 * @return json
 */
	require('noheader-coon.php');
	require('getInformation.php');
	session_start();
	define('DIR_ROOT', str_replace('\\','/',dirname(__FILE__)));//获取当前文件物理路径
	// echo count($_FILES['userfile']['tmp_name']);

	$username     = $_SESSION['username'];
	$name 		  = $_POST['create-name'];
	$intro        = $_POST['create-intro'];
	$create_time  = $_POST['create-time'];
	$create_place = $_POST['create-place'];
	$create_price = $_POST['create-price'];
	$createtime   = date("Y-m-d H:i:s"); //创建时间
	$num          = count($_FILES['userfile']['tmp_name'])-1; //图片总数

	$bool = 0;//判断是否都添加上去了

	$userid    = getUseridByUsername($username);
	$countryid = getCountryidByCountryname($create_place);
	$time=time();

	$pathName = $username.'-'.$countryid.'-'.$time; //存放文件夹名称,用户名-乡村id-时间
	// echo $userid.$countryid;
	// echo $username."<br>".$create_time."<br>".$create_place."<br>".$create_price;
	// echo $pathName;
	// echo $num.$name;
	if(!$username){
		echo "您还未登录";
		return;
	}

	for ($i=1;$i<count($_FILES['userfile']['tmp_name']);$i++)  
	{  
		//$upfile=$new_folder."/".$_FILES['userfile']['name'][$i];//此处路径换成你的  
		$m=$i;  
		$m="0".$m;  

		$file = $_FILES['userfile']['name'][$i];
		$brr  = explode('.', $file);
		$type = $brr[1];

		$upfile="../img/photo/".$pathName."/".$m.".".$type."";  


		$tmp_file_path = DIR_ROOT.'/../img/photo/'.$pathName.'/';//在根目录下增加tmp目录的路径
		if(!is_dir($tmp_file_path)){
			// createFolder(dirname($tmp_file_path)); 
			mkdir($tmp_file_path);//如果不存在tmp目录，则建立
		}


		if( file_exists($upfile) && is_file( $upfile ) ){  
		  unlink( $upfile);//删除图片  
		}  
		if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i],$upfile)){  
			// echo "第".$i."张图片上传成功<br>";
			$bool+=1;  
		}else{  
			echo "<span style='color:#F00'>"."第".$i."张图片上传不了<br>";  
		}  
	}  

	if($num == 0){
		$tmp_file_path = DIR_ROOT.'/../img/photo/'.$pathName.'/';//在根目录下增加tmp目录的路径
		if(!is_dir($tmp_file_path)){
			// createFolder(dirname($tmp_file_path)); 
			mkdir($tmp_file_path);//如果不存在tmp目录，则建立
		}
	}

	if($bool == $num){
		$sql = mysql_query("insert into photo(name,intro,place,time,pay,pictures,num,userid,createtime)values('$name','$intro','$create_place','$create_time','$create_price','$pathName','$num','$userid','$createtime')");
		echo "<script>alert('创建成功');location.href='../login.html';</script>";
	}
?>
