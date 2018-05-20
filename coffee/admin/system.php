<?php
header("Content-Type: text/html;charset=utf-8");

//抑制所有的错误信息
ini_set('display_errors', 'off');

//计算页面运行时间函数
function getmicrotime(){
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}
$pagestartime=getmicrotime();

//显示常量
define("on", "<font color=\"green\"><b>Yes</b></font>");
define("off", "<font color=\"red\"><b>No</b></font>");
define("version", "v0.05.5");//版本号
define("overtime","2011.4.6&nbsp;&nbsp;19:30");//完成时间

//显示开关


//性能信息结果刷新
$ts_int = (false == empty($_POST['tsint']))?$_POST['tsint']:test_int();
$ts_float = (false == empty($_POST['tsfloat']))?$_POST['tsfloat']:test_float();
$ts_io = (false == empty($_POST['tsio']))?$_POST['tsio']:test_io();
if(isset($_POST['speed']))
{
    $speed=round(100/($_POST['speed']/1000),2);
}
elseif($_GET['speed']=="0")
{
    $speed=6666.67;
}
elseif(isset($_GET['speed']) and $_GET['speed']>0)
{
    $speed=round(100/($_GET['speed']/1000),2);
}
else
{
    $speed="<font color=red>&nbsp;未探测&nbsp;</font>";
}
//phpinfo()信息列举
switch ($_GET['action']){
    case "phpinfo_GENERAL":
        phpinfo(INFO_GENERAL+INFO_ENVIRONMENT+INFO_VARIABLES);
        exit;
    case "phpinfo_CONFIGURATION":
        phpinfo(INFO_CONFIGURATION);
        exit;
    case "phpinfo_MODULES":
        phpinfo(INFO_MODULES);
        exit;
    case "phpinfo":
        phpinfo();
        exit;
    default:
        break;
}
//表单处理
if($_POST['action']=="整数运算")
{
    $ts_int=test_int();
}
elseif($_POST['action']=="浮点运算")
{
    $ts_float=test_float();
}
elseif($_POST['action']=="IO测试")
{
    $ts_io=test_io();
}
elseif($_POST['action']=="开始测试")//网速测试，等你来完善。
{
    ?>
    <script language="javascript" type="text/javascript">
        var acd1;
        acd1 = new Date();
        acd1ok=acd1.getTime();
    </script>
    <?php
    for($i=1;$i<=1000;$i++){
        echo "<!--567890#########0#########0#########0#########0#########0#########0#########0#########012345-->";
    }
    ?>
    <script language="javascript" type="text/javascript">
        var acd2;
        acd2 = new Date();
        acd2ok=acd2.getTime();
        window.location = '?speed=' +(acd2ok-acd1ok)+'#bottom';
    </script>
    <?php
}
elseif($_POST['action'] == "连接Mysql")
{
    $mysqlReShow = "show";
    $mysqlRe = "MYSQL连接测试结果：";
    $mysqlRe .= (false !==mysql_connect($_POST['mysqlhost'], $_POST['mysqluser'], $_POST['mysqlpsd']))?"<font color=\"#009900\">MYSQL服务器连接正常</font>，":"<font color=\"red\">MYSQL服务器连接失败！</font>, ";
    $mysqlRe .= "数据库 <b>".$_POST['mysqldb']."</b>&nbsp; ";
    $mysqlRe .= (false != @mysql_select_db($_POST['mysqldb']))?"<font color=\"#009900\">连接正常</font>":"<font color=\"red\">连接失败！</font>";
    if(false !==mysql_connect($_POST['mysqlhost'], $_POST['mysqluser'], $_POST['mysqlpsd']))
    {
        $mysql_version=mysql_get_server_info();
    }
    else
    {
        $mysql_version="<font color=red>获取失败！</font>";
    }
    $mysqlRe .= "，Mysql服务器版本：";
    $mysqlRe .= $mysql_version;
}


//判断函数定义情况
function getfunexists($funame)
{
    return (false !== function_exists($funame))?on:off;
}
//整数运算测试
function test_int()
{
    $startime=getmicrotime();
    for($i = 0; $i < 3000000; $i++);
    {
        $t = 1+1;
    }
    $endtime=getmicrotime();
    $time=round($endtime-$startime,4);
    return $time;
}
//浮点数运算测试
function test_float()
{
    $startime=getmicrotime();
    for($i = 0; $i < 3000000; $i++);
    {
        sqrt($t);
    }
    $endtime=getmicrotime();
    $time=round($endtime-$startime,4);
    return $time;
}
//IO能力测试
function test_io()
{
    $fp = fopen($_SERVER['PHP_SELF'], "r");
    $startime=getmicrotime();
    for($i = 0; $i < 300000; $i++);
    {
        fread($fp, 10240);
        rewind($fp);
    }
    $endtime=getmicrotime();
    $time=round($endtime-$startime,4);
    return $time;
}
//获取磁盘信息、disk_x_space("y")的参数不能用变量,@在这里不起作用
$diskct=0;
$disk=array();
/*if(@disk_total_space("A:")!=NULL) *为防止影响服务器，不检查软驱 - 阿江说的
{
	$diskct=1;
	$disk["A"]=round((@disk_free_space("A:")/(1024*1024*1024)),2)."G&nbsp;/&nbsp;".round((@disk_total_space("A:")/(1024*1024*1024)),2).'G';
}*/
$diskz=0; //磁盘总容量
$diskk=0; //磁盘剩余容量
if(@disk_total_space("B:")!=NULL)
{
    $diskct++;
    $disk["B"][0]=round(@disk_free_space("B:")/(1024*1024*1024),2).'G';
    $disk["B"][1]=round(@disk_total_space("B:")/(1024*1024*1024),2).'G';
    $disk["B"][2]=round(((@disk_free_space("B:")/(1024*1024*1024))/(@disk_total_space("B:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("B:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("B:")/(1024*1024*1024)),2);
}
if(@disk_total_space("C:")!=NULL)
{
    $diskct++;
    $disk["C"][0]=round((@disk_free_space("C:")/(1024*1024*1024)),2).'G';
    $disk["C"][1]=round((@disk_total_space("C:")/(1024*1024*1024)),2).'G';
    $disk["C"][2]=round(((@disk_free_space("C:")/(1024*1024*1024))/(@disk_total_space("C:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("C:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("C:")/(1024*1024*1024)),2);
}
if(@disk_total_space("D:")!=NULL)
{
    $diskct++;
    $disk["D"][0]=round((@disk_free_space("D:")/(1024*1024*1024)),2).'G';
    $disk["D"][1]=round((@disk_total_space("D:")/(1024*1024*1024)),2).'G';
    $disk["D"][2]=round(((@disk_free_space("D:")/(1024*1024*1024))/(@disk_total_space("D:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("D:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("D:")/(1024*1024*1024)),2);
}
if(@disk_total_space("E:")!=NULL)
{
    $diskct++;
    $disk["E"][0]=round((@disk_free_space("E:")/(1024*1024*1024)),2).'G';
    $disk["E"][1]=round((@disk_total_space("E:")/(1024*1024*1024)),2).'G';
    $disk["E"][2]=round(((@disk_free_space("E:")/(1024*1024*1024))/(@disk_total_space("E:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("E:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("E:")/(1024*1024*1024)),2);
}
if(@disk_total_space("F:")!=NULL)
{
    $diskct++;
    $disk["F"][0]=round((@disk_free_space("F:")/(1024*1024*1024)),2).'G';
    $disk["F"][1]=round((@disk_total_space("F:")/(1024*1024*1024)),2).'G';
    $disk["F"][2]=round(((@disk_free_space("F:")/(1024*1024*1024))/(@disk_total_space("F:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("F:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("F:")/(1024*1024*1024)),2);
}
if(@disk_total_space("G:")!=NULL)
{
    $diskct++;
    $disk["G"][0]=round((@disk_free_space("G:")/(1024*1024*1024)),2).'G';
    $disk["G"][1]=round((@disk_total_space("G:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("G:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("G:")/(1024*1024*1024)),2);
}
if(@disk_total_space("H:")!=NULL)
{
    $diskct++;
    $disk["H"][0]=round((@disk_free_space("H:")/(1024*1024*1024)),2).'G';
    $disk["H"][1]=round((@disk_total_space("H:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("H:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("H:")/(1024*1024*1024)),2);
}
if(@disk_total_space("I:")!=NULL)
{
    $diskct++;
    $disk["I"][0]=round((@disk_free_space("I:")/(1024*1024*1024)),2).'G';
    $disk["I"][1]=round((@disk_total_space("I:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("I:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("I:")/(1024*1024*1024)),2);
}
if(@disk_total_space("J:")!=NULL)
{
    $diskct++;
    $disk["J"][0]=round((@disk_free_space("J:")/(1024*1024*1024)),2).'G';
    $disk["J"][1]=round((@disk_total_space("J:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("J:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("J:")/(1024*1024*1024)),2);
}
if(@disk_total_space("K:")!=NULL)
{
    $diskct++;
    $disk["K"][0]=round((@disk_free_space("K:")/(1024*1024*1024)),2).'G';
    $disk["K"][1]=round((@disk_total_space("K:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("K:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("K:")/(1024*1024*1024)),2);
}
if(@disk_total_space("L:")!=NULL)
{
    $diskct++;
    $disk["L"][0]=round((@disk_free_space("L:")/(1024*1024*1024)),2).'G';
    $disk["L"][1]=round((@disk_total_space("L:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("L:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("L:")/(1024*1024*1024)),2);
}
?>
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
  <link rel="shortcut icon" href="img/favicon/favicon.png">


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
        <li><a href="order.php"><i class="icon-shopping-cart"></i>订单管理</a></li>
        <li><a href="user.php"><i class="icon-group"></i>用户管理</a></li>
        <li><a href="sql.php"><i class="icon-paste"></i>数据库备份</a></li>
        <li><a href="system.php" class="open"><i class="icon-desktop"></i>系统信息</a></li>
      </ul>
    </div>

    <!-- Sidebar ends -->

  	  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left"><i class="icon-desktop"></i> 系统信息</h2>

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


            <div style="margin-left: 50px;font-size: 13px;">
                <table width="900" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                        <td colspan="2" class="h">
                            <a name="tx" id="tx"></a>
                            <div style="float:left;width:49%">
                                <font face="Webdings, sans-serif">8</font>服务器参数    </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="126" class="e">服务器域名/IP：</td>
                        <td width="571"><?php echo $_SERVER['SERVER_NAME']."&nbsp;(".$_SERVER['REMOTE_ADDR'].")"; ?></td>
                    </tr>
                    <tr>
                        <td class="e">Web服务端口：</td>
                        <td><?php echo $_SERVER['SERVER_PORT']; ?></td>
                    </tr>
                    <tr>
                        <td class="e">服务器类型/版本：</td>
                        <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
                    </tr>
                    <tr>
                        <td class="e">服务器操作系统：</td>
                        <td><?php echo PHP_OS."&nbsp;(".php_uname().")"; ?></td>
                    </tr>
                    <tr>
                        <td class="e">网站跟目录：</td>
                        <td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td>
                    </tr>
                    <tr>
                        <td class="e">当前文件位置：</td>
                        <td><?php echo $_SERVER['SCRIPT_FILENAME']; ?></td>
                    </tr>
                    <!-- 如果系统不是WINNT的，不显示以下信息 -->
                    <?php if (PHP_OS=="WINNT"){?>
                        <tr>
                            <td class="e">系统目录：</td>
                            <td><?php echo getenv('SystemRoot')?getenv('SystemRoot'):"<font color=red>获取失败！</font>"; ?>
                                <div id="sysroot" class="notice" style="display:none;">
                                    <div style="border-bottom:1px dashed #ccc"></div>
                                    <strong>Path：</strong><?php echo getenv('Path')?getenv('Path'):"<font color=red>获取失败！</font>"; ?><br />
                                    <strong>TEMP：</strong><?php echo getenv('TEMP')?getenv('TEMP'):"<font color=red>获取失败！</font>"; ?><br>
                                    <strong>PATHEXT：</strong><?php echo getenv('PATHEXT')?getenv('PATHEXT'):"<font color=red>获取失败！</font>"; ?></div></td>
                        </tr>
                        <tr>
                            <td class="e">处理器(CPU)信息：</td>
                            <td><?php echo getenv('PROCESSOR_IDENTIFIER')?getenv('PROCESSOR_IDENTIFIER'):"<font color=red>获取失败！</font>"; ?>
                                <div id="cpu" class="notice" style="display:none;">
                                    <div style="border-bottom:1px dashed #ccc;"></div>
                               </div></td>
                        </tr>
                        <tr>
                            <td class="e">处理器(CPU)个数：</td>
                            <td><?php echo getenv('NUMBER_OF_PROCESSORS')?getenv('NUMBER_OF_PROCESSORS'):"获取失败！"; ?>
                                <div id="cpunm" class="notice" style="display:none;">
                                    <div style="border-bottom:1px dashed #ccc;"></div>
                                   </div></td>
                        </tr>
                    <?php }?>
                    <tr>
                        <td class="e">服务器时间：</td>

                        <td><?php
                            date_default_timezone_set('PRC');
                            echo date("Y年n月j日 H:i:s ");?></td>
                    </tr>
                    <!-- 如果系统不是WINNT的，不显示以下信息 -->
                    <?php if (PHP_OS=="WINNT"){?>
                        <tr>
                            <td class="e">磁盘空间信息：</td>
                            <td>
                                <?php if($diskct>0) {?>
                                    <table width="100%">
                                        <tr><th width="50">盘符</th><th width="80">总空间</th><th width="80">剩余空间</th><th>剩余百分比</th></tr>
                                        <?php foreach($disk as $key=>$value){ ?>
                                            <tr>
                                                <td><?php echo $key.'盘'; ?></td>
                                                <td><?php echo $value[1]; ?></td>
                                                <td><?php echo $value[0]; ?></td>
                                                <td>
                                                    <div style="border:1px solid #999">
                                                        <div style="width:<?php echo $value[2]; ?>;background-color:green; color:#FFF;"> <?php echo $value[2]; ?></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr style="background-color: #E5E5E5">
                                            <th>总计</th>
                                            <td><?PHP

                                                echo $diskz; ?>G</td>
                                            <td><? echo $diskk.'G'; ?></td>
                                            <td>
                                                <div style="border:1px solid #999">
                                                    <div style="width:<?php echo round(($diskk/$diskz)*100,2) ?>%;background-color:green; color:#FFF;"> <?php echo round(($diskk/$diskz)*100,2) ?>%</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                <?php }else{echo '探测失败！';} ?>
                                <br />
                                声明：只能探测盘符为大写字母A-L的磁盘，且有权限获取！
                            </td>
                        </tr>
                    <?php }?>
                </table>



                <!-- Matter -->

            </div>
            <div style="margin-left: 50px;font-size: 13px;">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#bottom" style="margin:0;">
                    <input name="tsint" type="hidden" value="<?php echo $ts_int;?> " />
                    <input name="tsfloat" type="hidden" value="<?php echo $ts_float;?> " />
                    <input name="tsio" type="hidden" value="<?php echo $ts_io;?> " />
                    <input name="speed" type="hidden" value="<?php echo $speed;?> " />
                    <table width="700" border="0" cellspacing="1" cellpadding="0">

                        <tr>
                            <td colspan="4" class="h"><a name="xn" id="xn"></a><font face="Webdings, sans-serif">8</font>服务器性能测试</td>
                        </tr>
                        <tr>
                            <td width="250" class="vr">检测对象</td>
                            <td width="148" class="vr">整数运算能力测试<br />
                                (1+1运算300万次)</td>
                            <td width="148" class="vr">浮点运算能力测试<br />
                                (开平方300万次)</td>
                            <td width="148" class="vr">数据I/O能力测试<br />
                                (读取<font color="red"><?php echo (round(filesize("xuhao.php")/1024)!=0)?round(filesize("xuhao.php")/1024):"44";?>K</font>文件30万次)</td>
                        </tr>
                        <tr>
                            <td class="center">AMD4000+  1G</td>
                            <td class="center">0.3502 秒</td>
                            <td class="center">0.3591 秒</td>
                            <td class="center">0.0394 秒</td>
                        </tr>
                        <tr>
                            <td class="center">92合租浙江贵宾10人合租空间</td>
                            <td class="center">0.2112 秒</td>
                            <td class="center">0.2240 秒</td>
                            <td class="center">0.0225 秒</td>
                        </tr>
                        <tr>
                            <td class="center">正在使用的这台服务器</td>
                            <td class="center"><?php echo "<font color=\"#006600\"><b>".$ts_int."</b></font>"; ?> 秒<br /><input name="action" type="submit" class="gbutton" value="整数运算" /></td>
                            <td class="center"><?php echo "<font color=\"#006600\"><b>".$ts_float."</b></font>"; ?> 秒<br /><input name="action" type="submit" class="gbutton" value="浮点运算" /></td>
                            <td class="center"><?php echo "<font color=\"#006600\"><b>".$ts_io."</b></font>"; ?> 秒<br /><input name="action" type="submit" class="gbutton" value="IO测试" /></td>
                        </tr>
                        <tr>
                            <td class="center">网络速度测试：
                                <input name="action" type="submit" class="gbutton" value="开始测试" />
                                <br />
                                (向客户端传送 100k 字节数据)
                            </td>
                            <td colspan="3">
                                <table style="margin:0px;border:none;" align="center" width="500" border="0" cellspacing="0" cellpadding="0">
                                    <tr style="border-bottom:none;"><td height="15" width="32" style="border-bottom:none;">1M</td>
                                        <td height="15" width="231" style="border-bottom:none;"> 2M ADSL</td>
                                        <td height="15" width="237" style="border-bottom:none;"> 10M LAN</td>
                                    </tr>
                                </table>
                                <table style="margin:0px" align="center" width="500" border="0" cellspacing=0 cellpadding=0>
                                    <tr>
                                        <td bgcolor="#009900" style="padding:0;margin:0;height:10px;" width="<?php
                                        if(preg_match("/[^\d-., ]/",$speed))
                                        {
                                            echo "0";
                                        }
                                        else{
                                            echo 500*$speed/(1024*4);
                                        }
                                        ?>"></td>
                                        <td height="10" width="<?php
                                        if(preg_match("/[^\d-., ]/",$speed))
                                        {
                                            echo "500";
                                        }
                                        else{
                                            echo 500-500*$speed/(1024*4);
                                        }
                                        ?>"><?php echo $speed; ?> kb/s</td>
                                    </tr>
                                </table>
                                <?php echo (isset($_GET['speed']))?"向客户端传送100k字节数据使了<font color=\"red\">".$_GET['speed']."</font>毫秒":"<font color=red>&nbsp;未探测&nbsp;</font>" ?></td>
                        </tr>
                    </table>

                    <table width="700" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                            <td colspan="4" class="h"><font face="Webdings, sans-serif">8</font>自定义测试项目</td>
                        </tr>
                        <?php if(getfunexists("mysql_close")==on){?>
                            <tr>
                                <td colspan="4" class="e">Myslq数据库连接测试</td>
                            </tr>
                            <tr>
                                <td width="111">Mysql服务器：</td>
                                <td width="152"><label>
                                        <input name="mysqlhost" type="text" class="textborder" id="mysqlhost" size="15" />
                                    </label></td>
                                <td width="116">Mysql用户名：</td>
                                <td width="316"><label>
                                        <input name="mysqluser" type="text" class="textborder" id="mysqluser" size="15" />
                                    </label></td>
                            </tr>
                            <tr>
                                <td>Mysql密码：</td>
                                <td><label>
                                        <input name="mysqlpsd" type="text" class="textborder" id="mysqlpsd" size="15" />
                                    </label></td>
                                <td>Mysql数据库名称：</td>
                                <td><label>
                                        <input name="mysqldb" type="text" class="textborder" id="mysqldb" size="15" />
                                    </label>
                                    &nbsp;
                                    <label>
                                        <input name="action" type="submit" class="gbutton" id="button2" value="连接Mysql" />
                                    </label></td>
                            </tr>
                            <?php
                        }
                        if("show"==$mysqlReShow){
                            ?>
                            <tr>
                                <td colspan="4" class="vr2"><?php echo $mysqlRe; ?>
                                    <div id="mysql" class="notice" style="display:none;">
                                        <div style="border-bottom:1px dashed #ccc;"></div>
                                        服务器Mysql版本：<?php echo $mysql_version; ?> &nbsp;&nbsp;如果数据库连接失败，将无法探测该项！</div></td>
                            </tr>
                        <?php } ?>


                    </table>


                </form>
            </div>
        </div>
    </div>>




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