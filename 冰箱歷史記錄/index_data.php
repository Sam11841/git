<?php
date_default_timezone_set('Asia/Taipei');
$today=date('Y-m-d',strtotime("now"));
header('Content-Type: application/json; charset=utf-8');
include("./MYPDO/MYPDO.php"); //引入DB檔案
//一頁5筆
$page=1;
if(isset($_GET["page"]))
$page=$_GET["page"];//2
$pagesize=5;//2
$pagestart=5*($page-1);//5*1
$dataCount=0;

//首頁與查看撈資料 
$DB = new MYPDO("root","root1234","refrigerator");
//$delta="down";//預設為down;
$sql="SELECT * FROM food_info"; //全資料顯示 
if(isset($_GET["sort"])){
    $mode=explode(",",$_GET["sort"]);
    if($mode[0]=="Dead_Line")$sort_sql=" ORDER BY Vali_Date ".$mode[1];
    else $sort_sql=" ORDER BY ".$mode[0]." ".$mode[1];

}else{
    $mode=Array("Input_Date","desc");
    $sort_sql=" ORDER BY Input_Date desc";
}

$sql.=$sort_sql;

$query=$DB->prepare($sql);
$query->execute();

//計算總頁數
$dataCount=$query->rowCount();
$pageCount=ceil($dataCount/$pagesize);
$limit_sql=" limit ".$pagestart.",".$pagesize;
$sql.=$limit_sql;
$query=$DB->prepare($sql);
$query->execute();
$result=$query->fetchAll(PDO::FETCH_ASSOC);

if(empty($result)){
    $result="";
    $result=json_encode($result);
}else{
    for($i=0;$i<count($result);$i++){

        //echo $result[$i]["Vali_Date"]."-".strtotime("now")." ";

        $deadline=strtotime($result[$i]["Vali_Date"])-strtotime("now");

        
        if($deadline<=0){
            $result[$i]["Dead_Line"]="已過期";
            $result[$i]["Color"]="#FF5151";
        }
        else{
            $deadline=floor($deadline/86400);//60s*60m*24h=1天,以今天為基準
            if($deadline<7) $result[$i]["Color"]="#B7FF4A";
            else $result[$i]["Color"]="";
            $result[$i]["Dead_Line"]=$deadline; 
        }
        
    }

    if($mode[0]=="Dead_Line" && $mode[1]=="desc" ) array_multisort(array_column($result,'Dead_Line'),SORT_DESC);
    else if($mode[0]=="Dead_Line" && $mode[1]=="asc")array_multisort(array_column($result,'Dead_Line'),SORT_ASC);

    $result=json_encode($result);
    
}

$DB=null;//釋放

echo "{\"list\" : ".$result.",\"today\":\"".$today."\",\"keys\":\"".$mode[0]."\",\"act\":\"".$mode[1]."\",\"page_now\":".$page.",\"page_total\":".$pageCount."}";



?>