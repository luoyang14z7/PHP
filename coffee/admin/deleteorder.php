<?php


$con=mysqli_connect('127.0.0.1','root',"123456",'coffee',3306);

$id=$_GET['id'];


//删除指定数据
mysqli_query($con,"delete from orderlist where oid=$id;");
//排错并返回页面
if(mysqli_error()){
    echo mysqli_error();
}else{
    header("Location:order.php");
}
mysqli_close($con);