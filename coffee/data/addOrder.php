<?php
  header('Content-Type:application/json;charset=UTF-8');
  @$uid= $_POST['uid'] or die("{'code':1,'msg':'uid requeried'}");
  @$oname=$_POST['oname'] or die("{'code':2,'msg':'oname requeried'}");
  @$ophone=$_POST['ophone'] or die("{'code':3,'msg':'ophone requeried'}");
  @$oaddress=$_POST['oaddress'] or die("{'code':4,'msg':'oaddress requeried'}");
  @$opay=$_POST['opay'] or die("{'code':5,'msg':'opay requeried'}");
  @$oprice=$_POST['oprice'] or die("{'code':6,'msg':'oprice requeried'}");
  @$otime=$_POST['otime'] or die("{'code':7,'msg':'otime requeried'}");
  @$ostate=$_POST['ostate'] or die("{'code':8,'msg':'ostate requeried'}");
   require('init.php');
   $sql="INSERT INTO orderlist VALUES(NULL,'$uid','$oname','$ophone','$oaddress','$opay','$oprice','$otime','$ostate')";
   $result=mysqli_query($con,$sql);
   if($result==false){
     $output=[
             'code'=> 1,
             'msg' => 'sql error'
            ];
   }else{
   $oid=mysqli_insert_id($con);
     $output=[
             'code'=> 0,
             'msg' => 'success',
             'oid' => $oid
            ];
   }
   echo json_encode($output);
?>