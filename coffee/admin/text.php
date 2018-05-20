<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
<body>
<table border="0" cellpadding="0" cellspacing="0">



    <?php
    $con=mysqli_connect('127.0.0.1','root',"123456",'coffee',3306);

    $result=mysqli_query($con,"SELECT * FROM users ORDER BY uid");
    $dataCount=mysqli_num_rows($result);



    for($i=0;$i<$dataCount;$i++){
        $result_arr=mysqli_fetch_assoc($result);
        $id=$result_arr['uid'];
        $name=$result_arr['uphone'];
        $pwd=$result_arr['upwd'];

        echo "
<table>    


    ";
    }






    ?>

    </tbody>
</table>
注意:5个字符以上数据库不能添加

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    $(function(){

        $('table td').click(function(){
            if(!$(this).is('.input')){
                $(this).addClass('input').html('<input type="text" value="'+ $(this).text() +'" />').find('input').focus().blur(function(){
                    var thisid = $(this).parent().siblings("th:eq(0)").text();
                    var thisvalue=$(this).val();
                    var thisclass = $(this).parent().attr("class");

                    $.ajax({
                        type: 'POST',
                        url: 'update.php',
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
</body>   </html>