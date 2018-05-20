<?php
    header('Content-Type:application/json;charset=UTF-8');
    @$oid=$_POST['oid'] or die("{'code':2,'msg':'oid requeried'}");
    @$pid=$_POST['pid'] or die("{'code':2,'msg':'pid requeried'}");
    @$count=$_POST['count'] or die("{'code':2,'msg':'count requeried'}");
    require('init.php');
     $sql="INSERT INTO orderdetail VALUES(NULL,'$oid','$pid','$count')";
     $result=mysqli_query($con,$sql);
     if($result===false){
             $output=[
                    'code'=> 1,
                    'msg' => 'sql error'
              ];
     }else{
            $output=[
                     'code'=> 0,
                     'msg' => 'success'
            ];
     }
     echo json_encode($output);
?>