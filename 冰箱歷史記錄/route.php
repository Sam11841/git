<?php
header("Content-Type:text/html; charset=utf-8");

if($_GET["act"]=="insert"||$_GET["act"]=="again") {
    include("insert_data.html");
}else if($_GET["act"]=="edit"||$_GET["act"]=="detail"){
    header("Location:detail.php?id=".$_GET["id"]."&action=".$_GET["act"]);
}else if($_GET["act"]=="delete"){
    header("Location: delete.php?id=".$_GET["id"]);
}else{
    header("Location: ./");
}


?>