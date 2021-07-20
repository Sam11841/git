<?php

header("Content-Type:text/html; charset=utf-8");
require("upload_img.php");
include("./MYPDO/MYPDO.php"); //引入DB檔案
$data_correct=true;//#檢查餵參數和操作流程
$img_path=$_POST["before_img"];   
//時效檢查 置入時間>今天 保存時間<今天 保存時間<置入時間 過去不可大於未來
$vali_date=strtotime($_POST["vali_date"]);
$input_date=strtotime($_POST["input_date"]); 
if($input_date>strtotime("now")||$vali_date<strtotime("now")||$vali_date<$input_date){
    echo "<script>alert('日期格式有誤請再次檢查 ex: 置入時間>今天 保存時間<今天 保存時間<置入時間')</script>";
    $data_correct=false;
    
}



//存取圖檔 
if($data_correct && $_FILES["upload_img"]["tmp_name"]!=""){
    $img_path=upload_img($_FILES,"upload_img");
    if($img_path=="")$data_correct=false; 
}

//檢查錯誤回上一頁
if(!$data_correct){
    echo "<script>history.go(-1)</script>";
    exit;
} 

//做update
$DB = new MYPDO("root","root1234","refrigerator");
$sql="UPDATE food_info set Name=?,Unit=?,Freeze=?,Class=?,Input_Date=?,Vali_Date=?,Img_Path=? where ID=?";//塞資料語法
$query=$DB->prepare($sql);

$query->execute(array($_POST["name"],$_POST["unit"],$_POST["freeze"]
,$_POST["class"],$_POST["input_date"],$_POST["vali_date"],$img_path,$_POST["fid"]));

$DB=null;//釋放

//轉頁
echo "<script>";
echo "window.location.replace('./');";
echo "</script>";

?>