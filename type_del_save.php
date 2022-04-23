<?php
	include('conn.php');
	$type_id = $_POST['type_id'];
	mysqli_query($conn,"DELETE FROM newstype WHERE type_id='$type_id'");
	echo "<script>alert('删除成功！');history.go(-2);</script>";
?>