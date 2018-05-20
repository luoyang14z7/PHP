<?php
header('Content-Type:application/json;charset=UTF-8');
    @$did=$_REQUEST['did'] or die("{'code':2,'msg':'did requeried'}");
    require('init.php');
     $sql="DELETE FROM cartdetail WHERE did='$did'";
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