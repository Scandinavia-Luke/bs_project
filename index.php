<?php
    require_once('conn.php');
    $key_word = @ $_POST['key_word'];
?>
<html>
<head>
    <title>新闻管理系统</title>
	<meta content="text/html" charset="utf-8"/>
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
        <div class="content">
            <div class="content_left">
                <div class="news_type">
                    <p>新闻分类：</p>
                    <?php
                        $sql2 = mysqli_query($conn,"SELECT * FROM newstype ORDER BY type_id ASC");
                        while ($info2 = mysqli_fetch_array($sql2))
                        {
                            $type_id = $info2['type_id'];
                            $type_name = $info2['type_name'];
                            echo "<span><a href='index_type.php?type_id=$type_id'>[$type_name]</a></span>";
                        }
                    ?>
                </div>
            </div>
            <div class="content_right">
                <form name="form1" method="post" action="index.php">
                    <span>查询主题：<input type="text" name="key_word" id="key_word" value="">
                    <input type="submit" name="news_query" id="news_query" value="查 询"></span>
                </form>
                <table class="news_list1">
                    <caption>最新新闻：</caption>
                    <tr>
                        <th class="tb_title">主 题</th>
                        <th class="tb_date">加入时间</th>
                        <th class="tb_detail">详细内容</th>
                    </tr>
                    <?php
                    $sql1 = mysqli_query($conn,"SELECT COUNT(*) AS total FROM news
                      WHERE news_title LIKE '%$key_word%'");
                    $info1 = mysqli_fetch_array($sql1);
                    $total = $info1['total'];
                    if($total == 0)
                    {
                        echo "本系统暂无任何查询数据。";
                        exit;
                    }
                    else
                    {
                        $page_size = 10;
                        if($total <= $page_size)
                        {
                            $page_connt = 1;
                        }
                        if(($total % $page_size) != 0)
                        {
                            $page_connt = intval($total/$page_size) + 1;
                        }
                        else
                        {
                            $page_connt = intval($total/$page_size);
                        }
                        if((@ $_GET['page']) == "")
                        {
                            $page = 1;
                        }
                        else
                        {
                            $page = intval($_GET['page']);
                        }
                        $sql1 = mysqli_query($conn,"SELECT * FROM news WHERE news_title LIKE '%$key_word%' 
                          ORDER BY news_id ASC LIMIT "
                            .(($page-1)*$page_size).",$page_size");
                        while($info1 = mysqli_fetch_array($sql1))
                        {
                            $news_id = $info1['news_id'];
                            $news_title = $info1['news_title'];
                            $news_date = $info1['news_date'];
                            echo "<tr>";
                            echo "<td class='tb_l'>$news_title</td>";
                            echo "<td class='tb_c'>$news_date</td>";
                            echo "<td class='tb_c'><a href='index_newscontent.php?news_id=$news_id' title='$news_title'>查看</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
                <table class="page_list1">
                    <?php
                    echo "<tr>";
                    echo "<td>共有数据&nbsp;$total&nbsp;条，每页显示&nbsp;$page_size&nbsp;条； 第&nbsp;$page&nbsp;页/共&nbsp;$page_connt&nbsp;页:&nbsp;";
                    if($page >= 2)
                    {
                        echo "<a href='index.php?page=1' title='首页'>&nbsp;首&nbsp;&nbsp;页&nbsp;</a>/<a href='index.php?page="
                        .($page-1)."' title='前一页'>前一页</a>&nbsp;&nbsp;";
                    }
                    if($page_connt >= 2)
                    {
                        for($i=1; $i<=$page_connt; $i++)
                        {
                            echo "<a href='index.php?page=$i'>&nbsp;$i&nbsp;</a>";
                        }
                    }
                    if($page >= 2)
                    {
                        echo "<a href='index.php?page=".(($page+1)>=$page_connt?$page_connt:($page+1)).
                            "' title='后一页'>&nbsp;&nbsp;后一页</a>/<a href='index.php?page=$page_connt' title='尾页'>尾页</a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    ?>
 
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