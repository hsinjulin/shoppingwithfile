<?php
    session_start();
    //撈取上一頁點擊產品的id
    $pId = $_GET["id"];

    //建立session儲存
    $idArr = $_SESSION["id"];
    //將撈取的產品的id加入陣列
    $idArr[] = $pId;
    //將陣列回傳至session儲存
    $_SESSION["id"] = $idArr;
    
    print_r($idArr);
    header("Location:login.php");
?>