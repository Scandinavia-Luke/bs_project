<?php
session_start();
require_once('conn.php');
$key_word = @ $_POST['key_word'];
?>
<html>
<head>
    <title>系统后台</title>
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
                echo "<span>管理员：[$user_name] 欢迎您！&nbsp;&nbsp;<a href='admin_logout.php'>退出登录</a>&nbsp;&nbsp;<a href='admin_view.php'>个人信息</a>&nbsp;&nbsp;<a href='admin_loginout.php'>注销用户</a></span>";
            }
        ?>
    </div>
    <div class="top_banner">
        <span>新闻管理系统后台</span>
    </div>
    <div class="content_bk">
        <div class="content_left">
            <div class="news_type">
                <table>
                    <tr>
                        <th>新闻管理系统后台中心：</th>
                    </tr>
                    <tr>
                        <td><a href="news_add.php">添加新闻</a></td>
                    </tr>
                    <tr>
                        <td><a href="type_add.php">添加新闻分类</a></td>
                    </tr>
                    <tr>
                        <td>分类/管理</td>
                    </tr>
                    <?php
                    $sql2 = mysqli_query($conn,"SELECT * FROM newstype ORDER BY type_id ASC");
                    while ($info2 = mysqli_fetch_array($sql2))
                    {
                        $type_id = $info2['type_id'];
                        $type_name = $info2['type_name'];
                        echo "<tr>";
                        echo "<td>[$type_name]&nbsp;&nbsp;<a href='type_upd.php?type_id=$type_id'>修改</a>
                        &nbsp;&nbsp;<a href='type_del.php?type_id=$type_id'>删除</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
 
            </div>
        </div>
        <div class="content_right">
            <form name="form1" method="post" action="admin.php">
                    <span>查询主题：<input type="text" name="key_word" id="key_word" value="">
                    <input type="submit" name="news_query" id="news_query" value="查 询"></span>
            </form>
            <table class="news_list1">
                <caption>新闻列表：</caption>
                <tr>
                    <th class="tb_title">标 题</th>
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
                        echo "<td class='tb_c'><a href='news_upd.php?news_id=$news_id'>修改</a>&nbsp;&nbsp;
                            <a href='news_del.php?news_id=$news_id'>删除</a></td>";
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
                    echo "<a href='admin.php?page=1' title='首页'>&nbsp;首&nbsp;&nbsp;页&nbsp;</a>/<a href='admin.php?page="
                        .($page-1)."' title='前一页'>前一页</a>&nbsp;&nbsp;";
                }
                if($page_connt >= 2)
                {
                    for($i=1; $i<=$page_connt; $i++)
                    {
                        echo "<a href='admin.php?page=$i'>&nbsp;$i&nbsp;</a>";
                    }
                }
                if($page >= 2)
                {
                    echo "<a href='admin.php?page=".(($page+1)>=$page_connt?$page_connt:($page+1)).
                        "' title='后一页'>&nbsp;&nbsp;后一页</a>/<a href='admin.php?page=$page_connt' title='尾页'>尾页</a>";
                }
                echo "</td>";
                echo "</tr>";
                ?>
 
            </table>
 
        </div>
    </div>
 
    <div class="footer">
        <p>基于PHP+MySQL+HTML的新闻管理系统。</p>
    </div>
</div>
</body>
</html>