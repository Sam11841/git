<?php
header("Content-Type:text/html; charset=utf-8");
require("upload_img.php");
include("./MYPDO/MYPDO.php"); //引入DB檔案
date_default_timezone_set('Asia/Taipei');
$data_correct=true;//#檢查餵參數和操作流程
   
//時效檢查 置入時間>今天 保存時間<今天 保存時間<置入時間 過去不可大於未來
$vali_date=strtotime($_POST["vali_date"]);
$input_date=strtotime($_POST["input_date"]); 
if($input_date>strtotime("now")||$vali_date<strtotime("now")||$vali_date<$input_date){
    echo "<script>alert('日期格式有誤請再次檢查 ex: 置入時間>今天 保存時間<今天 保存時間<置入時間')</script>";
    $data_correct=false;
    
}

//存取圖檔 
if($data_correct){
    $img_path=upload_img($_FILES,"img");
    if($img_path=="")$data_correct=false; 
}

//檢查錯誤回上一頁
if(!$data_correct){
    echo "<script>history.go(-1)</script>";
    exit;
} 

//做insert
$DB = new MYPDO("root","root1234","refrigerator");
$sql="insert into food_info (Name,Unit,Freeze,Class,Input_Date,Vali_Date,Img_Path) VALUES(?,?,?,?,?,?,?)";//塞資料語法
$query=$DB->prepare($sql);
$query->execute(array($_POST["name"],$_POST["unit"],$_POST["freeze"]
,$_POST["class"],$_POST["input_date"],$_POST["vali_date"],$img_path));
$DB=null;//釋放

//轉頁
echo "<script>";
echo "window.location.replace('route.php?act=".$_POST["act"]."');";
echo "</script>";

//返回首頁

?>