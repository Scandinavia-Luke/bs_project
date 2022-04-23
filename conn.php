<?php
	$conn=mysqli_connect('localhost','root','') or die('数据库连接失败!');
	mysqli_select_db($conn, 'news') or die('数据库选择失败!');
	mysqli_query($conn,"set names utf8");	//设置数据库编码格式为utf-8

	if(mysqli_connect_errno($conn))
	{
		echo "数据库连接MySql连接失败".mysqli_connect_error()."<br>";
	}
?>
