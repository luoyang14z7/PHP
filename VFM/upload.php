<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//包含一个文件上传类中的上传类
include "fileupload.php";

$up = new fileupload;
//设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
session_start();
$dir="userdir/".$_SESSION['username'];
$up -> set("path", "$dir");
$up -> set("maxsize", 2000000);
$up -> set("allowtype", array("exe", "xlsx", "jpg","docx","rar"));
$up -> set("israndname", false);

//使用对象中的upload方法， 就可以上传文件， 方法需要传一个上传表单的名子 pic, 如果成功返回true, 失败返回false
if($up -> upload("pic")) {


    ?>
    <script>
        alert("上传成功！");
        window.location.href="index.php";
    </script>

    <?php


} else {
     ?>
<script>
    alert("上传失败！");
    window.location.href="index.php";
</script>
<?php
}
?>