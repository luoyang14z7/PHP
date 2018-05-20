<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$pid=$_POST['pid'];
$pname=$_POST['pname'];
$ptitle=$_POST['ptitle'];
$pinfo=$_POST['pinfo'];
$pOrigin=$_POST['pOrigin'];
$pwork=$_POST['pwork'];
$ptasty=$_POST['ptasty'];
$pacidity=$_POST['pacidity'];
$palcohol=$_POST['palcohol'];
$pmfood=$_POST['pmfood'];
$plike=$_POST['plike'];
$price=$_POST['price'];
$img=$_POST['img'];
$bming=$_POST['bmimg'];
header ( "Content-type:text/html;charset=utf-8" );  //统一输出编码为utf-8
$con=mysqli_connect('127.0.0.1','root',"123456",'coffee',3306);
mysqli_query($con,'set names utf8');
$sql = mysqli_query($con,"select * from product where pid=$pid");

if(mysqli_fetch_array($sql) < 1){  //查询表中有多少行
    mysqli_query($con,"INSERT INTO `coffee`.`product` (`pid`, `pname`, `ptitle`, `pinfo`, `pOrigin`, `pwork`, `ptasty`, `pacidity`, `palcohol`, `pmfood`, `plike`, `price`, `img`, `bmimg`) VALUES ('$pid','$pname','$ptitle','$pinfo','$pOrigin','$pwork','$ptasty','$pacidity','$palcohol','$pmfood','$plike','$price','$img','$bming')");
    echo "
<script>
    alert(\"添加成功！\");
    window.location.href=\"addshop.php\";
</script>";

}else{
    echo "
<script>
    alert(\"商品编号重复，添加失败！\");
    window.location.href=\"addshop.php\";
</script>";
}

?>






