<?php
header('Content-Type:application/json;charset=UTF-8');
@$pageNum=$_REQUEST['pageNum'];
if($pageNum===null){//客户端未提交pageNum,默认值为1
	$pageNum=1;
}else{//客户端提交了pageNum,字符串解析为整数
	$pageNum =intval($pageNum);
}
require('init.php');
$output=[//向客户端输出的分页数据
	'recordCount'=>0,
	'pageSize'=>9,
	'pageCount'=>0,
	'pageNum'=>$pageNum,
	'data'=>null
];
//查询总的记录数量
$sql="SELECT COUNT(*) FROM product";
$result=mysqli_query($con,$sql);//结果集中有一行一列的数据
$output['recordCount']=intval(mysqli_fetch_row($result)[0]);

//计算出总页数 (上取整)
$output['pageCount']=ceil($output['recordCount'] / $output['pageSize']);

//查询指定页中的数据
$start=($output['pageNum']-1)*$output['pageSize'];//从哪一行记录开始读取
$count=$output['pageSize'];//一次最多读取的记录数量
$sql="SELECT * FROM product LIMIT $start,$count";
$result=mysqli_query($con,$sql);
$output['data']=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($output);