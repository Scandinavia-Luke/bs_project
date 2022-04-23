<?php
	include('conn.php');
	$type_id = $_POST['type_id'];
	$type_name = $_POST['type_name'];
	mysqli_query($conn,"UPDATE newstype SET type_name='$type_name' WHERE type_id='$type_id'");
	echo "<script>alert('修改成功！');history.go(-2);</script>";
?>