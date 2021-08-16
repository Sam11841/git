<?php
header("Content-Type:text/html; charset=utf-8");
include("./MYPDO/MYPDO.php"); //引入DB檔案
date_default_timezone_set('Asia/Taipei');
$today=date('Y-m-d',strtotime("now"));
//
$DB = new MYPDO("root","root1234","refrigerator");
$sql="select * from food_info where id= ?"; //全資料顯示 #排序
$query=$DB->prepare($sql);
$query->execute(array($_GET["id"]));

$result=$query->fetchAll(PDO::FETCH_ASSOC);

if(empty($result)){
    $result="資料庫內未有相關資料，請新增資料!";
    $result=json_encode($result);
}else{    
    $Dead_Line=strtotime($result[0]["Vali_Date"])-strtotime("now");
    if($Dead_Line<=0){
        $result[0]["Dead_Line"]="已過期";
    }
    else{
        $Dead_Line=floor($Dead_Line/86400);//60s*60m*24h=1天,以今天為基準
        $result[0]["Dead_Line"]=$Dead_Line;
    }
    $result[0]["Show"]=$_GET["action"];
    $result=json_encode($result);
   
}
echo "<script scr=\"js/detail.js\">";
echo "var food_obj=".$result.";";
echo "var today='".$today."';";
echo "</script>";
include("detail.html");

?>