<?php
	include('conn.php');
	
	$news_id = $_POST['news_id'];
	
	mysqli_query($conn,"DELETE FROM news WHERE news_id=$news_id");
	
	echo "<script>alert('删除成功！');history.go(-2);</script>";
?>
 