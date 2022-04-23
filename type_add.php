<?php
session_start();
require_once('conn.php');
 
?>
<html>
<head>
    <title>添加分类</title>
    <link type="text/css" rel="stylesheet" href="css/backstage.css">
    <script type="text/javascript">
        function chkinput(form)
        {
            if(form.type_name.value == "")
            {
                document.getElementById('error_note').innerHTML = "错误提示：请填写分类名称！";
                form.type_name.style.backgroundColor = "red";
                form.type_name.select();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container_bk">
    <div  class="top_navigation">
        <?php
        if(@ $_SESSION['user_name'] == "")
        {
            echo "<script>alert('您还没有登录，请先登录!');history.back();</script>";
            exit;
        }
        else
        {
            $user_name = $_SESSION['user_name'];
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
        <form name="form1" method="post" action="type_add_save.php" onsubmit="return chkinput(this)">
            <table class="typeadd_tb">
                <tr>
                    <td colspan="2"><strong>添加新闻分类：</strong></td>
                </tr>
                <tr>
                    <td class="tb_l">新闻分类名称：</td>
                    <td><input type="text" name="type_name" id="type_name"></td>
                </tr>
                <tr>
                    <td class="tb_l">&nbsp;</td>
                    <td><input type="submit" name="button1" id="button1" value="添 加">
                        <input type="reset" name="button2" id="button2"><span id="error_note">&nbsp;</span></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="footer">
        <p>基于PHP+MySQL+HTML的新闻管理系统</p>
    </div>
</div>
</body>
</html>