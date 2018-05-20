

<?php
$con=mysqli_connect('127.0.0.1','root',"123456",'coffee',3306);
$id = trim($_REQUEST['thisid']);
$thisclass = trim($_REQUEST['thisclass']);
$thisvalue= trim($_REQUEST['thisvalue']);
if (substr_count($thisclass," ")>0){
    $thisclass=str_replace(" ","",$thisclass);
}
if (substr_count($thisclass,"input")>0){
    $thisclass=str_replace("input","",$thisclass);
}
$update_sql = "update users set $thisclass='$thisvalue' where uid='$id'";

$result = mysqli_query($con,$update_sql);
mysqli_close($con);
?>
