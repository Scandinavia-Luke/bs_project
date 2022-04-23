<?php

session_start();				//或者要启动；
require_once('conn.php');		//连接数据库；

?>

<html>
	<head>
		<meta charset="utf-8" />
		<title>管理员信息</title>
		<link type="text/css" rel="stylesheet" href="css/backstage.css" />
		<style>
		td{
			width: 6.25rem;
			height: 2.1875rem;
		}
		tr{
			height: 2.1875rem;
		}
		caption{
			font-size: x-large;
			font-family: "微软雅黑";
			font-weight: bold;
		}
		</style>
	</head>
	<body>
		<div class="container_bk">
			<div class="top_navigation">
				<?php
				if(@ $_SESSION['user_name'] == "")	//传值判断
				{
				    echo "<script>alert('您还没有登录，请先登录!');history.back();</script>";
				    exit;
				}
				else
				{
				    $user_name = $_SESSION['user_name'];	//取得session值
				    echo "<span>管理员：[$user_name] 欢迎您！&nbsp;&nbsp;<a href='admin_logout.php'>退出登录</a></span>";
				    echo "<span>&nbsp;&nbsp;<a href='admin.php'>后台首页</a>&nbsp;&nbsp;</span>";
				    echo "<span>&nbsp;&nbsp;<a href='admin_loginout.php'>注销用户</a>&nbsp;&nbsp;</span>";
				}
				?>
			</div>
			<div class="top_banner">
				<span>新闻管理系统后台</span>
			</div>
			<div class="content_bk">
				<table border="" cellpadding="1" cellspacing="0" width="400" style="margin: auto;">
					<?php
						$key_word = @ $_POST['key_word'];
						$sql="select * from admin where a_username='$user_name'";
						$result=mysqli_query($conn,$sql);
						$row=mysqli_fetch_array($result);
					?>
					<caption>管 理 员 信 息</caption>
						<tr align="center" height="35">
							<td style="width: 7rem">管理员：</td>
							<td><?php echo "".$row['a_username']."<br />";?></td>
						</tr>
						<tr align="center" height="35">
							<td>性别：</td>
							<td><?php echo "".$row['a_sex']."<br />";?></td>
						</tr>
						<tr align="center" height="35">
							<td>爱好：</td>
							<td><?php echo "".$row['a_hobby']."<br />";?></td>
						</tr>
						<tr align="center" height="35">
							<td>年龄：</td>
							<td><?php echo "".$row['a_age']."<br />";?></td>
						</tr>
						<tr align="center" height="35">
							<td>国籍：</td>
							<td><?php echo "".$row['a_nationality']."<br />";?></td>
						</tr>
						<tr align="center" height="35">
							<td>邮箱：</td>
							<td><?php echo "".$row['a_email']."<br />";?></td>
						</tr>
						<tr align="center" height="35">
							<td>备注：</td>
							<td><?php echo "".$row['a_note']."<br />";?></td>
						</tr>
				</table>
			</div>
			<div class="footer">
				<p>基于PHP+MySQL+HTML的新闻管理系统</p>
			</div>
		</div>
	</body>
</html>