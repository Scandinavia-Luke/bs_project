<html>
<head>
    <title>后台登录</title>
	<meta charset="utf-8" />
	<link type="text/css" rel="stylesheet" href="css/login.css" />
</head>
<body>
	<form name="form1" method="post" action="admin_check.php">
		<h1 class="tt">管理员登录</h1>
		<input type="text" name="user_name" id="user_name" placeholder="用户名" />
		<!-- name里面是传递输入的值 -->
		<input type="password" name="pwd" id="pwd" placeholder="密码" />
		<input class="btn_tt" type="submit" name="button1" id="button1" value="登 录" />
		<input class="btn_tt" type="reset" name="button3" id="button3" value="注 册" onclick="window.location='register.php'" />
		<p><a href="index.php">返回首页</a></p>
		<sapn>提示：用户 admin, 密码123 </sapn><span>  用户 root，密码 456 </span>
	</form>
</body>
</html>
