

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>添加商品</title>
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
    <link href="css/shoptable.css" rel="stylesheet">
    <link rel="stylesheet" href="css/zzsc.css" type="text/css">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-1.3.2.min.js"></script> <!-- 你必须先引入jQuery1.8或以上版本 -->
    <script src="layer/layer.js"></script>

    <!-- HTML5 Support for IE -->
    <!--[if lt IE 9]>
    <script src="js/html5shim.js"></script>
    <![endif]-->
    <style type="text/css">
       input {
           margin-left: 10px;
       }
        textarea {
            margin-left: 10px;
            height: 40px;
            width: 200px;

        }
        b {
            text-align: center;
        }
        div {
            padding-top: 7px;
        }
    </style>
</head>







<body>
<div style="float: left;display: inline;">
<form action="upload.php" method="post" enctype="multipart/form-data" style="margin-left: 40px;margin-top: 35px;">
    <b style="font-size: 20px;">请先上传商品图片文件</b> <input type="file" name="pic" value="" style="margin-top: 10px;">

    <input type="submit" value="上传"  style="margin-top:10px;width:100px; height: 30px;"/>

</form>
</div>
<div  style="float: left;display: inline;">
<FORM ACTION="addshopsql.php" METHOD="POST" style="margin-left: 50px;margin-top: 25px;">
    <div><b  style="margin-left: 40px;">商品编号：</b><input  width="20px;" type="text" name="pid" style="width: 40px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">(按已有编号排序)</div>
    <div><b style="margin-left: 40px;">商品名称：</b><input  width="20px;" type="text" name="pname"></div>
    <div><b style="margin-left: 40px;">商品简介：</b><input  width="20px;" type="text" name="ptitle"></div>
    <div><b style="margin-left: 40px;">商品介绍：</b><textarea  width="20px;"   name="pinfo" ></textarea></div>
    <div><b style="margin-left: 40px;">商品产地：</b><input  width="20px;" type="text" name="pOrigin"></div>
    <div><b style="margin-left: 40px;">加工方法：</b><input  width="20px;" type="text" name="pwork"></div>
    <div><b style="margin-left: 40px;">商品风味：</b><textarea  width="20px;" name="ptasty"></textarea></div>
    <div><b style="margin-left: 40px;">商品酸度：</b><input  width="20px;" type="text" name="pacidity"></div>
    <div><b style="margin-left: 40px;">商品醇度：</b><input  width="20px;" type="text" name="palcohol"></div>
    <div><b style="margin-left: 40px;">搭配建议：</b><textarea width="20px;" name="pmfood"></textarea></div>
    <div><b style="margin-left: 40px;">类似咖啡：</b><textarea  width="20px;"  name="plike"></textarea></div>
    <div><b style="margin-left: 40px;">商品价格：</b><input  width="20px;" type="text" name="price" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onafterpaste="this.value=this.value.replace(/[^\d.]/g,'')"></div>
    <div><b style="margin-left: 40px;">商品简图：</b><input  width="20px;" type="text" name="img">(例：images/p13.jpg)</div>
    <div><b style="margin-left: 40px;">商品大图：</b><input  width="20px;" type="text" name="bmimg">(例：images/lp13.jpg)</div>

    <INPUT TYPE="submit" value="添加商品" style="margin-top: 15px;width:100px; height: 40px;margin-left: 69px;">
    <button type="reset" value="Reset" style="margin-top: 15px;width:100px; height: 40px;margin-left: 29px;">重置</button>
</FORM>
</div>
</body>
</html>

