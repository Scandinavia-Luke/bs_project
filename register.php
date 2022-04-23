<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>用户注册页面</title>
</head>

<body>
    <form method="post" action="">
    <div align="center"><font size="5" color="blue">新用户注册</font></div>
    <table width="550" align="center" bgcolor="#CCFFCC">
    <tr>
        <td width="185" align="right">用户名：</td>
        <td><input type="text" name="name" align="center"/></td>
        <td width="120"><font color="red" >*1-20个字符</font></td>
    </tr>
    <tr>
        <td align="right">登录密码：</td>
        <td><input type="password" name="pw1" /></td>
        <td><font color="red">*6-20个字符</font></td>
    </tr>
    <tr>
        <td align="right">确认密码：</td>
        <td><input type="password" name="pw2" /></td>
        <td><font color="red">*6-20个字符</font></td>
    </tr>
    <tr>
        <td align="right">邮件地址：</td>
        <td><input type="email" name="email" /></td>
    </tr>
    <tr>
        <td align="right">性别：</td>
        <td>
            <input type="radio" name="sex" value="男" />男
            <input type="radio" name="sex" value="女" />女
        </td>
    </tr>
    <tr>
        <td align="right">年龄：</td>
        <td><input type="text" name="age" align="center" /></td>
    </tr>
    <tr>
        <td align="right">爱好：</td>
        <td><input type="checkbox" name="hobby[]" value="唱歌"/>唱歌
            <input type="checkbox" name="hobby[]" value="跳舞"/>跳舞
            <input type="checkbox" name="hobby[]" value="rap"/>rap
            <input type="checkbox" name="hobby[]" value="足球"/>足球
            <input type="checkbox" name="hobby[]" value="跑步"/>跑步
        </td>
    </tr>
    <tr>
        <td align="right">国籍：</td>
        <td>
            <select name="GJ">
            <option>中国</option>
            <option>巴基斯坦</option>
            <option>俄罗斯</option>
            <option>斯堪的纳维亚</option>
            </select>
        </td>
    </tr>
    <tr>
        <td align="right">备注：</td>
        <td>
        <textarea name="BZ" rows="5" cols="22"></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center">
        <input type="submit" name="TJ" value="提交"/>
        <input type="reset" name="CZ" value="重置"/>
        <p><a href="admin_login">返回登陆</a></p>
        </td>
    </tr>
    </table>
</body>

</html>
<?php
if(isset($_POST['TJ']))
{
    $name=$_POST["name"];
    $pw1=$_POST['pw1'];
    $pw2=$_POST['pw2'];
    $email=$_POST['email'];
    $sex=$_POST['sex'];
    $age=$_POST['age'];
    $hobby=$_POST['hobby'];
    $nationality=$_POST['GJ'];
    $note=$_POST['BZ'];
    $checkname=preg_match('/^\w{1,20}$/',$name);    //使用正则表达式检查用户名
    $checkpw1=preg_match('/^\w{6,20}$/',$pw1);
    $checkemail=preg_match('/^[a-zA-Z0-9_\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/',$email);
    if(!$checkname)
		echo "<script>alert('用户名设置错误!');</script>";
	elseif(!$checkpw1)
		echo "<script>alert('密码设置错误!');</script>";
	elseif(!$sex)
		echo "<script>alert('性别为必选项!');</script>";
	elseif($email&&(!$checkemail))
		echo "<script>alert('email格式错误!');</script>";
	elseif($pw1!==$pw2)
		echo "<script>alert('两次输入的密码不一致!');</script>";
	else
    {
        include "conn.php";				//连接数据库
        $sql1 = mysqli_query($conn,"select * from admin where a_username = '$name'");	//执行数据库相关语句
		$result1 = mysqli_fetch_array($sql1);	//从结果集中取得一行作为关联数组或数字数组，或二者兼有
        if(!$result1)
        {
			$hobby_arr = array();
			$hobby_arr = $_POST['hobby'];
			$hobby = implode('、', $hobby_arr);	//返回一个由数组元素组成的字符串
			
			//mysqli_select_db($conn,'news');
			$sql2 = mysqli_query($conn,"insert into admin(a_username,a_password,a_sex,a_age,a_hobby,a_nationality,a_email,a_note) 
			values('$name','$pw2','$sex','$age','$hobby','$nationality','$email','$note')");
            //$result2 = mysqli_fetch_array($sql2);
            if(!$sql2)
            {
                echo "错误为：";
                die("<script>alert('注册失败！');</script>".mysqli_error($conn));	//提示注册失败的错误信息
            }
            else
				echo "<script>alert('注册成功！');location.href='admin_login.php';</script>";
        }
        else
        {
			echo "<script>alert('该账户已存在，请勿重复注册！');</script>";
        }
    }
}
?>