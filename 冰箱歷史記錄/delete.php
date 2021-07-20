<?php
date_default_timezone_set('Asia/Taipei');
$today=date('Y-m-d',strtotime("now"));
header("Content-Type:text/html; charset=utf-8");
include("./MYPDO/MYPDO.php"); //引入DB檔案

$del_id=explode(",",$_GET["id"]);
$tmp_id = implode(',', array_fill(0, count($del_id), '?')); 

//刪除upload圖檔
$DB = new MYPDO("root","root1234","refrigerator");
$sql="SELECT Img_Path FROM food_info WHERE ID in($tmp_id)";//塞資料語法
$query=$DB->prepare($sql);
$query->execute($del_id);
$result=$query->fetchAll(PDO::FETCH_ASSOC);
if(empty($result)){
    $result="資料庫內未有相關資料，請新增資料!";
}else{
    for($i=0;$i<count($result);$i++){
        if(file_exists($result[$i]["Img_Path"])){
            unlink($result[$i]["Img_Path"]);
           
        }else{
            echo"<script>alert('此圖檔不存在或已刪除')</script>";
        }
    }
}

//資料搬移到expired

//複製舊表到新表語法 https://www.runoob.com/php/pdostatement-execute.html

$DB = new MYPDO("root","root1234","refrigerator");
$sql="SELECT ID,Name,Unit,Freeze,Class,Input_Date,Vali_Date FROM food_info WHERE ID in($tmp_id)";//塞資料語法
$query=$DB->prepare($sql);
$query->execute($del_id);
$result=$query->fetchAll(PDO::FETCH_ASSOC);
if(empty($result)){
    $result="資料庫內未有相關資料";
}else{
    $sql="INSERT INTO expired(ID,Name,Unit,Freeze,Class,Input_Date,Vali_Date,Delete_Date)VALUES(?,?,?,?,?,?,?,?)";
    $query=$DB->prepare($sql);
    $query->execute(array($result[0]["ID"],$result[0]["Name"],$result[0]["Unit"],$result[0]["Freeze"]
    ,$result[0]["Class"],$result[0]["Input_Date"],$result[0]["Vali_Date"],$today));
}

//資料刪除
$sql="DELETE FROM food_info WHERE ID in($tmp_id)";
$query=$DB->prepare($sql);
$query->execute($del_id);
$DB=null;//釋放



//回首頁
echo "<script>";
echo "window.location.replace('./');";
echo "</script>";

?>