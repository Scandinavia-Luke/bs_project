<?php
session_start();
require_once('conn.php');
 
?>
<html>
<head>
    <title>删除新闻</title>
    <link type="text/css" rel="stylesheet" href="css/backstage.css">
 
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
        <form name="form1" method="post" action="savedel.php">
            <table class="newsadd_tb">
                <?php
                $news_id = $_GET['news_id'];
                $sql1 = mysqli_query($conn,"SELECT * FROM news WHERE news_id=$news_id");
                $info1 = mysqli_fetch_array($sql1);
                ?>
                <tr>
                    <td colspan="2"><strong>删除新闻：您确认要删除此新闻吗？</strong></td>
                </tr>
                <tr>
                    <td>新闻标题：</td>
                    <td><input type="text" name="news_title" id="news_title" disabled="disabled" value="<?php echo $info1['news_title'];?>">
                        <input type="hidden" name="news_date" id="news_date" disabled="disabled" value="<?php echo date("Y-m-d");?>">
                        <input type="hidden" name="news_id" id="news_id" value="<?php echo $info1['news_id'];?>"></td>
                </tr>
                <tr>
                    <td>新闻分类：</td>
                    <td><select name="news_type" id="news_type" disabled="disabled">
                            <?php
                            $sql = mysqli_query($conn,"SELECT * FROM newstype");
                            while($info = mysqli_fetch_array($sql))
                            {
                                $type_id = $info['type_id'];
                                $type_name = $info['type_name'];
                                echo "<option value=$type_id>$type_name</option>";
                            }
                            ?>
                        </select>&nbsp;*&nbsp;&nbsp;
                        作者：<input type="text" name="news_author" id="news_author" disabled="disabled" value="<?php echo $info1['news_author'];?>"></td>
                    <?php
                    $t_id = $info1['news_type'];
                    $t_id -= 1; // selectedIndex是从0开始的，数据库ID是从1开始的，为了匹配需减去1.
                    echo "<script>document.getElementById('news_type').selectedIndex='$t_id';</script>";
                    ?>
                </tr>
                <tr>
                    <td>新闻内容：</td>
                    <td><textarea name="news_content" rows="20" cols="100" disabled="disabled"><?php echo $info1['news_content'];?></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="button1" id="button1" value="删 除">
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