<?php
    header('Content-Type:application/json;charset=UTF-8');
    @$uid=$_REQUEST['uid'] or die("{'code':2,'msg':'uid requeried'}");
    @$pid=$_REQUEST['pid'] or die("{'code':2,'msg':'pid requeried'}");
    require('init.php');
    //获取该用户下购物车ID
    $sql="SELECT * FROM shopcart WHERE uid='$uid'";
    $result=mysqli_query($con,$sql);
    //判断是否有购物车有保存，没有插入一个
    if($result===false){
    //返回结果
        $output=[
        	'code'=> 4,
        	'msg' => 'sql error'
        ];
    }else{
        //获取结果集中是否有数据
        $row=mysqli_fetch_row($result);
        if($row){
             $cartid=$row[0];
        }else{
        //创建一个购物车且记录购物车ID
            $sql="INSERT INTO shopcart VALUES(NULL,'$uid')";
            $result=mysqli_query($con,$sql);
            $cartid=mysqli_insert_id($con);
        }
        //判断这个商品是否在购物车中存在
        $sql="SELECT * FROM cartdetail WHERE cartid='$cartid' AND productid='$pid'";
        $result=mysqli_query($con,$sql);
        if($result===false){
             $output=[
                    	'code'=> 4,
                    	'msg' => 'sql error'
                    ];
        }else{
             $row=mysqli_fetch_row($result);
                    if($row){
                         $did=$row[0];
                         $sql="UPDATE cartdetail SET count=count+1 WHERE did='$did'";
                          $result=mysqli_query($con,$sql);
                          if($result!==false){
                              $output=[
                                      'code'=> 0,
                                       'msg' => 'success'
                              ];
                          }
                    }else{
                        $sql="INSERT INTO cartdetail VALUES(NULL,'$cartid','$pid',1)";
                            $result=mysqli_query($con,$sql);
                            if($result===false){
                                 $output=[
                                          'code'=> 3,
                                          'msg' => 'sql error'
                                 ];
                            }else{
                                 $output=[
                                          'code'=> 0,
                                          'msg' => 'success'
                                 ];
                            }
                    }
        }

    }
    echo json_encode($output);
?>