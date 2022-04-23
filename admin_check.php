<?php
require_once('conn.php');
$user_name = $_POST['user_name'];
$pwd = $_POST['pwd'];
 
class chkinput
{
    var $name;
    var $password;
 
    function __construct($n,$p)
    {
        $this->name = $n;
        $this->password = $p;
    }
 
    function checkinput()
    {
        include('conn.php');
        $sql = mysqli_query($conn,"SELECT * FROM admin WHERE a_username='".$this->name."'");
        $info = mysqli_fetch_array($sql);
        if($info == false)
        {
            echo "<script>alert('用户名输入错误！');history.back();</script>";
            exit;
        }
        else
        {
            if($info['a_password']==$this->password)
            {
                session_start();
                $_SESSION['user_name'] = $info['a_username'];
                $_SESSION['id'] = $info['id'];
                header("location:admin.php");
                exit;
            }
            else
            {
                echo "<script>alert('密码输入不正确！');history.back();</script>";
                exit;
            }
        }
 
    }
 
}
 
$obj = new chkinput($user_name,$pwd);
$obj->checkinput();
 