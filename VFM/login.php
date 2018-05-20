<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登陆中……</title>
</head>

<body>
<?php
session_start();
$username=$_REQUEST["username"];
$password=$_REQUEST["password"];
$con=mysqli_connect('127.0.0.1','root',"123456",'vfm',3306);
if(!$con){
 die("数据库连接失败！");
 }
$dbusername=null;
$dbpassword=null;
$result=mysqli_query($con,"select * from users where username='".$username."';");
while($row=mysqli_fetch_array($result)){
 $dbusername=$row["username"];
 $dbpassword=$row["password"];
}
if(is_null($dbusername)){
?>
<script>
alert("无此用户！");
window.location.href="login.html";
</script>
<?php
 }
else{
 if($dbpassword!=$password){
?>
<script>
alert("密码错误！");
window.location.href="login.html";
</script>
<?php
 }
 else{
 $_SESSION["username"]=$username;
 $_SESSION["code"]=mt_rand(0,100000);
?>
<script>
window.location.href="index.php";
</script>
<?php
 }
 }
mysqli_close($con);
?>

</body>
</html>