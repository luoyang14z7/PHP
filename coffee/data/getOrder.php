<?php
    header('Content-Type:application/json;charset=UTF-8');
    @ $uid=$_REQUEST['uid'] or die("{'code':2,'msg':'uid requeried'}");
    require('init.php');
    $sql="SELECT * FROM orderlist WHERE uid='$uid'";
    $result=mysqli_query($con,$sql);
    if($result===false){
         $output=[
                  'code'=> 3,
                  'msg' => 'sql error'
                 ];
    }else{
        $list=mysqli_fetch_all($result,MYSQLI_ASSOC);
        if($list){
        $output=[
                  'code'=> 1,
                  'msg' => 'success',
                  'data' =>  $list
                 ];
        }else{
        $output=[
                'code'=> 0,
                'msg' => 'success',
                ];

        }
    }
    echo json_encode($output);
?>