<?php
	include('conn.php');
	
	$news_id = $_POST['news_id'];
	$news_title = $_POST['news_title'];
	$news_type = $_POST['news_type'];
	$news_author = $_POST['news_author'];
	$news_content = $_POST['news_content'];
	$news_date = $_POST['news_date'];
	
	mysqli_query($conn,"UPDATE news SET news_title='$news_title',news_type = '$news_type',news_content='$news_content',
	news_date='$news_date',news_author='$news_author' WHERE news_id='$news_id'");
	
	echo "<script>alert('修改成功！');history.go(-2);</script>";
?>