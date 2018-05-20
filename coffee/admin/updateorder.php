

<?php
$con=mysqli_connect('127.0.0.1','root',"123456",'coffee',3306);
header ( "Content-type:text/html;charset=utf-8" );  //统一输出编码为utf-8
$id = trim($_REQUEST['thisid']);
$thisclass = trim($_REQUEST['thisclass']);
$thisvalue= trim($_REQUEST['thisvalue']);
if (substr_count($thisclass," ")>0){
    $thisclass=str_replace(" ","",$thisclass);
}
if (substr_count($thisclass,"input")>0){
    $thisclass=str_replace("input","",$thisclass);
}
$update_sql = "update orderlist set $thisclass='$thisvalue' where oid='$id'";
mysqli_query($con,'set names utf8');
$result = mysqli_query($con,$update_sql);
mysqli_close($con);
?>
