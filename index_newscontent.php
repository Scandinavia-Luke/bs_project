<?php
require_once('conn.php');
?>
<html>
<head>
    <title>新闻内容</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/lunbo.css" />
	<script type="text/javascript" src="js/lunbo.js"></script>
</head>
<body>
<div class="container">
    <div class="top_navigation">
        <span>PHP新闻管理系统</span>
        <ul>
            <li><a href="index.php">系统首页</a></li>
            <li><a href="index_newscontent.php">最新新闻</a></li>
            <li><a href="index_type.php">新闻分类</a></li>
            <li><a href="admin_login.php">后台管理</a></li>
        </ul>
    </div>
    <div class="top_banner">
        <img src="images/banner3.jpg" alt="banner">
    </div>
    <div class="news_content">
        <div>
            <table class="news_content_list">
                <?php
                if(empty($_GET['news_id']))
                {
                    $sql1 = mysqli_query($conn,"SELECT news_id,news_title FROM news ORDER BY news_id DESC");
                    $info1 = mysqli_fetch_array($sql1);
                    $news_id = $info1['news_id'];
                }
                else
                {
                    $news_id = $_GET['news_id'];
                }
                $sql1 = mysqli_query($conn,"SELECT * FROM news WHERE news_id=$news_id");
                $info1 = mysqli_fetch_array($sql1);
                ?>
                <tr>
                    <th class="tb_title">新闻标题:&nbsp;&nbsp;<?php echo $info1['news_title']?></th>
                    <th class="tb_date">加入时间:&nbsp;&nbsp;<?php echo $info1['news_date']?>&nbsp;&nbsp;</th>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: bold">新闻内容：</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-indent: 2em;line-height: 22px;"><?php echo $info1['news_content']?></td>
                </tr>
            </table>
        </div>
    </div>
		<!-- 大盒子 -->
		<div style="height:750px;"></div>
		<div class="box">
			<!-- 左侧按钮 -->
			<a href="javascript:;" class="left">&lt</a>
			<!-- 右侧按钮 -->
			<a href="javascript:;" class="right">&gt</a>
			<!-- 轮播图片 -->
			<ul class="imgs">
				<li class="one">
					<a href="#"><img src="images/1.jpg" alt=""></a>
				</li>
				<li class="two">
					<a href="#"><img src="images/2.JPG" alt=""></a>
				</li>
				<li class="three">
					<a href="#"><img src="images/3.jpg" alt=""></a>
				</li>
				<li class="four">
					<a href="#"><img src="images/4.jpg" alt="" class="rose"></a>
				</li>
				<li class="five">
					<a href="#"><img src="images/5.jpg" alt=""></a>
				</li>
				<li class="six">
					<a href="#"><img src="images/6.jpg" alt=""></a>
				</li>
			</ul>
			<!-- 小圆圈 -->
			<ul class="list">
			</ul>
			<!-- 两个空盒子，实现左右两侧图片点击效果 -->
			<div class="rights"></div>
			<div class="lefts"></div>
		</div>
		<div style="height:300px;"></div>
    <div class="footer">
        <p>基于PHP+MySQL+HTML的新闻管理系统</p>
    </div>
</div>
</body>
</html>