<?php
header('Content-Type: application/json; charset=utf-8');
include("./MYPDO/MYPDO.php"); //引入DB檔案

$page=1;
if(isset($_GET["page"]))
$page=$_GET["page"];//2
$pagesize=5;//2
$pagestart=5*($page-1);//5*1
$dataCount=0;

$DB = new MYPDO("root","root1234","refrigerator");
$sql="SELECT * FROM expired ORDER BY Vali_Date desc"; //全資料顯示

$query=$DB->prepare($sql);
$query->execute();

//計算總頁數
$dataCount=$query->rowCount();
$pageCount=ceil($dataCount/$pagesize);
$limit_sql=" limit ".$pagestart.",".$pagesize;
$sql.=$limit_sql;
//print_r($sql);
$query=$DB->prepare($sql);
$query->execute();
$result=$query->fetchAll(PDO::FETCH_ASSOC);

if(empty($result)){
    $result="";
    $result=json_encode($result);
}else{
    $result=json_encode($result);
}
$DB=null;//釋放
echo "{\"list\" : ".$result.",\"page_now\":".$page.",\"page_total\":".$pageCount."}";

?>