<?php
    header('Content-Type:application/json;charset=UTF-8');
    @$pid=$_REQUEST['pid'] or die('{"code":2,"msg":"pid required"}');
    require('init.php');
     $sql="SELECT * FROM product WHERE pid='$pid'";
     $result=mysqli_query($con,$sql);
     if($result===false){
        $output = [
                   'code'=>1,
                   'msg'=>'sql wrong'
                  ];
     }else{
        $row=mysqli_fetch_assoc($result);
        $output = [
                    'code'=>0,
                    'msg'=>'success',
                    'data'=>$row
                   ];
     }
     echo json_encode($output);
?>