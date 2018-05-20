<?php
    header('Content-Type:application/json;charset=UTF-8');
    @$uid=$_REQUEST['uid'] or die("{'code':2,'msg':'uid requeried'}");
    require('init.php');
    //通过uid来获取该用户的购物车id
    $sql="SELECT * FROM shopcart WHERE uid='$uid'";
    $result=mysqli_query($con,$sql);
    if($result ===false){
         $output=[
               'code'=> 4,
               'msg' => 'sql error'
         ];
    }else{
        //从结果中获取cid
        $row=mysqli_fetch_row($result);
        $cid=$row[0];
        //再通过cid获取该用户购物车中的所有商品及其信息
        $sql="SELECT * FROM cartdetail WHERE cartid='$cid'";
        $result=mysqli_query($con,$sql);
        if($result===false){
             $output=[
                      'code'=> 3,
                      'msg' => 'sql error'
               ];
        }else{
            $list=mysqli_fetch_all($result,MYSQLI_ASSOC);
            if($list){
                foreach ( $list  as & $value ) {
                      $count=$value['count'];
                      $pid=$value['productid'];
                      $did=$value['did'];
                      $sql="SELECT * FROM product WHERE pid='$pid'";
                      $result=mysqli_query($con,$sql);
                      if($result===false){
                      $output=[
                                'code'=> 5,
                                'msg' => 'sql error'
                              ];
                      }else{
                           $row=mysqli_fetch_assoc($result);
                             $row['count']=$count;
                             $row['did']=$did;
                             $plist[]=$row;
                      }
                }
                    $output=[
                              'code'=> 0,
                              'msg' => 'success',
                              'data'=>$plist
                    ];
                }else{
                 $output=[
                          'code'=>6,
                          'msg' => 'success',
                       ];
                }
             }
         }
    echo json_encode($output);
?>