<?php
// https://www.runoob.com/php/php-file-upload.html
header("Content-Type:text/html; charset=utf-8");
function upload_img($file,$name){
    
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $file[$name]["name"]);
    $path="";
    $extension = end($temp);  

    if ((($file[$name]["type"] == "image/gif")
    || ($file[$name]["type"] == "image/jpeg")
    || ($file[$name]["type"] == "image/jpg")
    || ($file[$name]["type"] == "image/pjpeg")
    || ($file[$name]["type"] == "image/x-png")
    || ($file[$name]["type"] == "image/png"))
    && ($file[$name]["size"] < 2048000)   
    && in_array($extension, $allowedExts))
    {
       
        if ($file[$name]["error"] > 0)
        {
            echo "錯誤訊息: " . $file[$name]["error"] . "<br>";
        }
        else
        {

            if (file_exists("upload/" . $file[$name]["name"]))
            {
                //echo $file[$name]["name"] . " 圖檔已经存在。 ";
                echo "<script>alert( '".$file[$name]["name"]." 此圖檔名稱已上傳 請從新上傳!' );</script>";
                
            }
            else
            {
                move_uploaded_file($file[$name]["tmp_name"], "upload/" . $file[$name]["name"]);
                //echo "圖檔在: " . "upload/" . $file[$name]["name"];
                echo "<script>alert('".$file[$name]["name"]." 圖檔已存取')</script>";
                $path="upload/" . $file[$name]["name"];
                
            }
        }
        return $path;
    }
    else
    {
        echo"<script>alert('請檢查以下狀況: 非圖檔副檔名,檔案超過2MB')</script>";
    }
}

?>