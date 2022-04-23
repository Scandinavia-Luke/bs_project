<?php

	session_start();
	session_destroy();
	require_once('conn.php');
	
	$user_name=@$_SESSION['user_name'];
	
	if(isset($_SESSION["user_name"]))  // 检测变量是否设置
	{
		$sql="delete from admin where a_username='$user_name'";
		$result=mysqli_query($conn,$sql);
		unset($_SESSION['user_name']);
		if(!isset($_SESSION['user_name']))
		echo "<script>alert('注销成功!');location.href='index.php';</script>";
	}
	exit;
 
?>