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
      <li><a href="index.php" class="open"><i class="icon-home"></i> 首页</a></li>
      <li><a href="shop.php"><i class="icon-list-alt"></i>商品管理</a></li>
      <li><a href="order.php"><i class="icon-shopping-cart"></i>订单管理</a></li>
      <li><a href="user.php"><i class="icon-group"></i>用户管理</a></li>
      <li><a href="sql.php"><i class="icon-paste"></i>数据库备份</a></li>
      <li><a href="system.php"><i class="icon-desktop"></i>系统信息</a></li>
    </ul>
  </div>

  <!-- Sidebar ends -->

  <!-- Main bar -->

  <!-- Main bar -->
  <div class="mainbar">

    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left"><i class="icon-calendar"></i> Calendar</h2>

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


    <!-- Matter -->

    <div class="matter">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Widget -->
            <div class="widget">
              <!-- Widget title -->
              <div class="widget-head">
                <div class="pull-left">Calendar</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="icon-remove"></i></a>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <!-- Widget content -->
                <div class="padd">
                  <!-- Below line produces calendar. I am using FullCalendar plugin. -->
                  <div id="calendar"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Matter ends -->

  </div>


    <!-- Matter -->




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