<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Candy=$_POST['candy'];



exec("F:/WAMP/wamp/bin/mysql/mysql5.6.17/bin/mysql -u root -p123456 coffee < F:/WAMP/wamp/www/coffee/sqldump/$Candy");
?>
    <script>
    alert("还原成功！");
    window.location.href="sql.php";
    </script>






