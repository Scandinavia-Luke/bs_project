<?php
session_start();
require_once('conn.php');
 
?>
<html>
<head>
    <title>添加新闻</title>
    <link type="text/css" rel="stylesheet" href="css/backstage.css">
    <script type="text/javascript">
        function chkinput(form)
        {
            if(form.news_title.value == "")
            {
                document.getElementById('error_note').innerHTML = "错误提示：请填写新闻标题！";
                form.news_title.style.backgroundColor = "red";
                form.news_title.select();
                return false;
            }
            if(form.news_author.value == "")
            {
                document.getElementById('error_note').innerHTML = "错误提示：请填写作者！";
                form.news_author.style.backgroundColor = "red";
                form.news_author.select();
                return false;
            }
            if(form.news_content.value == "")
            {
                document.getElementById('error_note').innerHTML = "错误提示：请填写新闻内容！";
                form.news_content.style.backgroundColor = "red";
                form.news_content.select();
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
        <form name="form1" method="post" action="saveadd.php" onsubmit="return chkinput(this)">
            <table class="newsadd_tb">
                <tr>
                    <td colspan="2"><strong>添加新闻：</strong></td>
                </tr>
                <tr>
                    <td>新闻标题：</td>
                    <td><input type="text" name="news_title" id="news_title">
                    <input type="hidden" name="news_date" id="news_date" value="<?php echo date("Y-m-d");?>"></td>
                </tr>
                <tr>
                    <td>新闻分类：</td>
                    <td><select name="news_type">
                        <?php
                            $sql = mysqli_query($conn,"SELECT * FROM newstype");
                            while($info = mysqli_fetch_array($sql))
                            {
                                $type_id = $info['type_id'];
                                $type_name = $info['type_name'];
                                echo "<option value='$type_id'>$type_name</option>";
                            }
                        ?>
                        </select>&nbsp;*&nbsp;&nbsp;作者：<input type="text" name="news_author" id="news_author"></td>
                </tr>
                <tr>
                    <td>新闻内容：</td>
                    <td><textarea name="news_content" rows="20" cols="100"></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
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