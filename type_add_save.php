<?php
	include('conn.php');
	$type_name = $_POST['type_name'];
	mysqli_query($conn,"INSERT INTO newstype(type_name) VALUES('$type_name')");
	echo "<script>alert('添加成功！');history.back();</script>";
?>