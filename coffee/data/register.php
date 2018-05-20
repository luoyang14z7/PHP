<?php
    header('Content-Type:application/json;charset=UTF-8');
    @ $uphone=$_REQUEST['uphone'] or die('{"code":2,"msg":"uphone required"}');
    @ $upwd=$_REQUEST['upwd'] or die('{"code":2,"msg":"upwd required"}');
    @ $type=$_REQUEST['type'];
    require('init.php');
    if($type===1){
        $sql="SELECT * FROM users WHERE uphone='$uphone'";
    }else{
         $sql="SELECT * FROM users WHERE uphone='$uphone' AND upwd='$upwd'";
    }
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_row($result);
    if($row == null){
        if($type==1){
             $sql="INSERT INTO users VALUES(NULL,'$uphone','$upwd','')";
                         $result=mysqli_query($con,$sql);
                         if($result === false){
                             $output = [
                                 'code'=>1,
                                 'msg'=>'sql wrong'
                             ];
                         }else{
                             $output = [
                                     'code'=>0,
                                     'msg'=>'success'
                             ];
              }
        }else{
                  $output = [
                         'code'=>5,
                         'msg'=>'账号或密码错误'
                  ];
        }
    }else{
        $output = [
            'code'=>3,
            'msg'=>'该账号已存在',
            'uid'=>$row[0]
        ];
    }
    echo json_encode($output);
?>