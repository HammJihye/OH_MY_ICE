<?php
date_default_timezone_set('Asia/Seoul');

$current_date1 = date("Y-m-d H:i:s");
$current_date = strtotime($current_date1);
$standard_time1 = date("Y-m-d")." 18:00:00";
$standard_time = strtotime($standard_time1);
$date_num=date('w', strtotime($current_date1));
$yoil = array("일","월","화","수","목","금","토");
if($date_num == 0 || $date_num == 6){ $weekend=1;}
else{$weekend=0;}

if($weekend==0 && ($current_date > $standard_time)){ 
    $current_date1 = date("Y-m-d", strtotime($current_date1."+6 hours"));
    $date_num +=1;
}

if(isset($_POST['chk'])){
    $proArr = $_POST['chk'];
    if($proArr[sizeof($proArr)-1]=="selectAll"){
        unset($proArr[sizeof($proArr)-1]);
    }
}
if(isset($_SESSION['ss_mb_id'])){
    $mb_id = trim($_SESSION['ss_mb_id']);
}
if(isset($_GET['menu'])){
    $category = $_GET['menu'];
}
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
else {
    $page = 1;
}
?>