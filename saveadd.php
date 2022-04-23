<?php
	include('conn.php');
	
	$news_title = $_POST['news_title'];
	$news_type = $_POST['news_type'];
	$news_author = $_POST['news_author'];
	$news_content = $_POST['news_content'];
	$news_date = $_POST['news_date'];
	
	mysqli_query($conn,"INSERT INTO news(news_title,news_type,news_content,news_date,news_author)
	  VALUES('$news_title',$news_type,'$news_content','$news_date','$news_author')");
	
	echo "<script>alert('添加成功！');history.go(-1);</script>";
?>