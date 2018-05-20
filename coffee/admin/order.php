<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>后台管理系统</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="">
  <!-- Stylesheets -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link rel="stylesheet" href="css/font-awesome.css">
  <!-- jQuery UI -->
  <link rel="stylesheet" href="css/jquery-ui.css">
  <!-- Calendar -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <!-- prettyPhoto -->
  <link rel="stylesheet" href="css/prettyPhoto.css">
  <!-- Star rating -->
  <link rel="stylesheet" href="css/rateit.css">
  <!-- Date picker -->
  <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
  <!-- CLEditor -->
  <link rel="stylesheet" href="css/jquery.cleditor.css">
  <!-- Uniform -->
  <link rel="stylesheet" href="css/uniform.default.css">
  <!-- Bootstrap toggle -->
  <link rel="stylesheet" href="css/bootstrap-switch.css">
  <!-- Main stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <!-- Widgets stylesheet -->
  <link href="css/widgets.css" rel="stylesheet">
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->

    <link href="css/shoptable.css" rel="stylesheet">
    <link rel="stylesheet" href="css/zzsc.css" type="text/css">
    <script src="js/jquery.min.js"></script>
</head>
<?php
session_start();
if(empty($_SESSION["code"])){
    ?>
    <script>
        alert("请正常登录！");
        window.location.href="exit.php";
    </script>
    <?php
}
?>
<body>

  <header>
    <div class="container">
      <div class="row">

        <!-- Logo section -->
        <div class="col-md-4">
          <!-- Logo. -->
          <div class="logo">
            <h1><a href="#">Coffee<span class="bold"></span></a></h1>
            <p class="meta">后台管理系统</p>
          </div>
          <!-- Logo ends -->
        </div>


          </div>
        </div>


  </header>

<!-- Header ends -->

<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <div class="sidebar">


        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
      <ul id="nav">
        <!-- Main menu with font awesome icon -->
        <li><a href="index.php"><i class="icon-home"></i> 首页</a></li>
        <li><a href="shop.php"><i class="icon-list-alt"></i>商品管理</a></li>
        <li><a href="order.php" class="open"><i class="icon-shopping-cart"></i>订单管理</a></li>
        <li><a href="user.php"><i class="icon-group"></i>用户管理</a></li>
        <li><a href="sql.php"><i class="icon-paste"></i>数据库备份</a></li>
        <li><a href="system.php"><i class="icon-desktop"></i>系统信息</a></li>
      </ul>
    </div>

    <!-- Sidebar ends -->

  	  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left"><i class="icon-shopping-cart"></i> 订单管理</h2>

        <!-- Breadcrumb -->
        <div class="bread-crumb pull-right">
          <a href="index.php"><i class="icon-home"></i> 首页</a>
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">控制台</a>
        </div>

        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->

        <?php
        header ( "Content-type:text/html;charset=utf-8" );  //统一输出编码为utf-8
        $con=mysqli_connect('127.0.0.1','root',"123456",'coffee',3306);
        mysqli_query($con,'set names utf8');
        $result=mysqli_query($con,"SELECT * FROM product ORDER BY pid");
        $dataCount=mysqli_num_rows($result);
        ?>


        <table class="imagetable" >

            <tr>
                <th style="width: 70px">订单编号</th>
                <th scope="col" style="width: 100px">用户ID</th>
                <th scope="col" style="width: 140px">收货人</th>
                <th scope="col" style="width: 200px">手机号码</th>
                <th scope="col" style="width: 90px">地址</th>
                <th scope="col" style="width: 100px">支付方式</th>
                <th scope="col" style="width: 150px">订单金额</th>
                <th scope="col"style="width: 150px">下单时间</th>
                <th scope="col"style="width: 500px">订单状态</th>

                <th style="width: 50px">删除</th>
            </tr>
            <tbody>
            <?php


            $rs=mysqli_query($con,"select * from `orderlist` where oid>0");
            if ($row = mysqli_fetch_array($rs,MYSQLI_BOTH))
            {
                do {
                    ?>

                    <tr  style="height: 80px;">
                        <th style="width: 70px"><?php echo $row['oid']?></th>
                        <th class="uid" style="width: 100px"><?php echo $row['uid']?></th>
                        <th class="oname" style="width: 140px"><?php echo $row['oname']?></th>
                        <th class="ophone" style="width: 200px"><?php echo $row['ophone']?></th>
                        <th class="oaddress" style="width: 90px"><?php echo $row['oaddress']?></th>
                        <th class="opay" style="width: 100px"><?php echo $row['opay']?></th>
                        <th class="oprice" style="width: 150px"><?php echo $row['oprice']?></th>

                        <th class="otime" style="width: 150px"><?php
                            $t=$row['otime'];
                            date_default_timezone_set('PRC');
                            echo (date("Y-m-d H:i:s",$t/1000));

                            ?></th>

                        <td class="ostate" style="width: 500px"><?php echo $row['ostate']?></td>
                        <?php
                        $id=$row['oid'];
                        echo    "<th style=\"width: 50px\"><a href='deleteorder.php?id=$id' >删除</a></th>"
                        ?>
                    </tr>
                    <?php
                }

                while ($row = mysqli_fetch_array($rs));
                mysqli_close($con);
            }?>

            </tbody>
        </table>

	    <!-- Matter -->
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript">
            $(function(){

                $('table td').click(function(){
                    if(!$(this).is('.input')){
                        $(this).addClass('input').html('<textarea>'+ $(this).text() +'</textarea>').find('textarea').focus().blur(function(){
                            var thisid = $(this).parent().siblings("th:eq(0)").text();
                            var thisvalue=$(this).val();
                            var thisclass = $(this).parent().attr("class");

                            $.ajax({
                                type: 'POST',
                                url: 'updateorder.php',
                                data: "thisid="+thisid+"&thisclass="+thisclass+"&thisvalue="+thisvalue
                            });
                            $(this).parent().removeClass('input').html($(this).val() || 0);
                        });
                    }
                }).hover(function(){
                    $(this).addClass('hover');
                },function(){
                    $(this).removeClass('hover');
                });

            });

        </script>


        <script type="text/javascript">
            $(function () {
                var $table=$('table');
                var currentPage=0;
                var pageSize=9;
                $table.bind('paging',function () {
                    $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();


                });
                var sumRows=$table.find('tbody tr').length;
                var sumPages=Math.ceil(sumRows/pageSize);
                var $pager=$('<div class="pagnation" id="pagnation"></div>');
                for(var pageIndex=0;pageIndex<sumPages;pageIndex++){
                    $('<a href="#" class="current"><span >'+(pageIndex+1)+'</span></a>').bind("click",{"newPage":pageIndex},function (event) {
                        currentPage=event.data["newPage"];
                        $table.trigger("paging");

                    }).appendTo($pager);
                    $pager.append(" ");

                }
                $pager.insertAfter($table);
                $table.trigger("paging");
            });
        </script>

              </div> 
            </div>


<!-- Content ends -->

<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
        <p class="copy">Copyright &copy; 2017-2018 | <a href="#">Your Site V_1.0</a> </p>
      </div>
    </div>
  </div>
</footer> 	

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 

<!-- JS -->
<script src="js/jquery.js"></script> <!-- jQuery -->
<script src="js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- jQuery Flot -->
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.stack.js"></script>

<!-- jQuery Notification - Noty -->
<script src="js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<script src="js/sparklines.js"></script> <!-- Sparklines -->
<script src="js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="js/jquery.uniform.min.js"></script> <!-- jQuery Uniform -->
<script src="js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="js/filter.js"></script> <!-- Filter for support page -->
<script src="js/custom.js"></script> <!-- Custom codes -->
<script src="js/charts.js"></script> <!-- Charts & Graphs -->

<!-- Script for this page -->


</body>
</html>