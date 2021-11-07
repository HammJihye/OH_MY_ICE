<?php
if(!isset($_SESSION['ss_mb_id'])){
    //로그인한 아이디가 없을 시에
    echo "<script>alert('로그인 해주세요.');</script>";
    echo "<script>location.replace('./index.php');</script>";
}
else{
    $admin_id = $_SESSION['ss_mb_id'];
    if(strpos($admin_id, "admin") !== false){
        //admin로그인 페이지에서 관리자 아이디가 아닌 아이디가 로그인했을 시에
    }
    else{
        echo "<script>alert('권한이 없는 아이디입니다.');</script>";
        echo "<script>location.replace('../product.php?menu=ice');</script>";
    }
}
?>