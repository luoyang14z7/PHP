<html>
<head>
    <title>文件云盘管理</title>
    <meta content="text/html; charset=utf-8" http-equiv="content-type" />
</head>
<body>
<?php
error_reporting(0);
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
<?php
    $dir="userdir/".$_SESSION['username'];
           if(isset($_GET['a'])){
                switch($_GET['a']){
                    case 'del':
                        unlink($_GET['filename']);
                        break;
                }
                ?>
<script>
window.location.href="index.php";
</script>
<?php

            }

        ?>
<center>
    <h1>文件云盘管理</h1>
<!--    <form action='index.php?a=upload' method='post'>
        文件：<input type='text' name='filename' />
        <input type='submit' value='上传' />
    </form> -->
    <form action="upload.php" method="post" enctype="multipart/form-data" style="margin-left: 40px;margin-top: 35px;">
        <b style="font-size: 20px;">请上传文件</b> <input type="file" name="pic" value="" style="margin-top: 10px;">

        <input type="submit" value="上传"  style="margin-top:10px;width:100px; height: 30px;"/>

    </form>
    <table border='1' width='900' cellpadding='5' cellspacing='0'>
        <tr>
            <th>文件名</th>
            <th>类型</th>
            <th>大小</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        <?php
                    //遍历目录
                    $dd=opendir($dir);
                    while(false !== ($f=readdir($dd))){
                        //过滤点
                        if($f == "." || $f == ".."){
                            continue;
                        }
                        //拼路径
                        $file=rtrim($dir,"/")."/".$f;
                        //防止中文乱码
                        $f2=iconv("gb2312","utf-8",$f);
                        echo "<tr>";
        echo "<td>{$f2}</td>";
        echo "<td>".filetype($file)."</td>";
        $size=floor(filesize($file)/1000);
        echo "<td>".$size."KB</td>";
        echo "<td>".date('Y-m-d H:i:s',(filectime($file)))."</td>";
        echo "<td align='center'>
        <a href='$file'>下载</a>|
        <a href='index.php?a=del&filename={$file}'>删除</a>
    </td>";
        echo "</tr>";

        }
        ?>
    </table>



</center>
</body>
</html>