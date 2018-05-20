<?php
if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")
{
    $user = $_POST["username"];
    $psw = $_POST["password"];
    $psw_confirm = $_POST["confirm"];
    if($user == "" || $psw == "" || $psw_confirm == "")
    {
        echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
    }
    else
    {
        if($psw == $psw_confirm)
        {
            $con=mysqli_connect('127.0.0.1','root',"123456",'vfm',3306);
            $sql = "select username from users where username = '$_POST[username]'";
            $result=mysqli_query($con,$sql);
            $num = mysqli_num_rows($result);
            if($num)
            {
                echo "<script>alert('用户名已存在'); history.go(-1);</script>";
            }
            else
            {
                $sql_insert = "insert into users values('$_POST[username]','$_POST[password]')";
                $res_insert=mysqli_query($con,$sql_insert);

                if($res_insert)
                {
                    $dir = iconv("UTF-8", "GBK", "userdir/$user");
                        mkdir ($dir,0777,true);
                    echo "<script>alert('注册成功！');
  
                    history.go(-1);</script>";
                }
                else
                {
                    echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
                }
            }
        }
        else
        {
            echo "<script>alert('密码不一致！'); history.go(-1);</script>";
        }
    }
}
else
{
    echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}
?>