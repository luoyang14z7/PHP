<?php
date_default_timezone_set('PRC');
$filename = date("Y-m-d-H-i-s").".sql";
$result = exec("F:/WAMP/wamp/bin/mysql/mysql5.6.17/bin/mysqldump -u root -p123456 coffee> F:/WAMP/wamp/www/coffee/sqldump/$filename");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script>
    alert("备份成功！");
    window.location.href="sql.php";
</script>
