<?php
include("./dbconn.php");
if(isset($_POST['login'])){
    $mode = trim($_POST['login']);//로그인페이지인지, 관리자페이지 로그인인지
    $mb_id = trim($_POST['mb_id']);
    $mb_pwd = trim($_POST['mb_pwd']);
    if($mode == "admin"){
        if(strpos($mb_id, "admin") !== false){
            //admin로그인 페이지에서 관리자 아이디가 아닌 아이디가 로그인했을 시에
        }
        else{
            echo "<script>alert('권한이 없는 아이디입니다.');</script>";
            echo "<script>location.replace('./product.php?menu=ice');</script>";
        }
    }
}

if(isset($_POST['pwd_chk'])){
    $chk_pwd = trim($_POST['mb_pwd_chk']);
    $chk_mb_id = trim($_POST['mb_id']);
    $myinfo_cate = trim($_POST['myinfo_cate']);
    $sql = "SELECT * FROM member where mb_id='$chk_mb_id'";
    $result = mysqli_query($conn, $sql);
    $mb_row = mysqli_fetch_array($result);
    if($mb_row['mb_pwd'] == $chk_pwd){
        mysqli_close($conn);
        
        switch($myinfo_cate){
            case "myinfo" : echo "<script>location.replace('./mypage/myinfo/myinfo.php');</script>";break;
            case "myaddress" :  echo "<script>location.replace('./mypage/myinfo/myaddress.php');</script>";break;
            case "delete_account" : echo "<script>location.replace('./mypage/myinfo/delete_account.php');</script>";break;
        }
    }
    else{
        echo "<script>alert('비밀번호가 맞지 않습니다.');</script>";
        switch($myinfo_cate){
            case "myinfo" : echo "<script>location.replace('./mypage/myinfo/pwd_check.php?myinfo_cate=myinfo');</script>";break;
            case "myaddress" :  echo "<script>location.replace('./mypage/myinfo/myaddress.php?myinfo_cate=myaddress');</script>";break;
            case "delete_account" : echo "<script>location.replace('./mypage/myinfo/delete_account.php?myinfo_cate=delete_account');</script>";break;
        }
        exit;
    }
}


if(!$mb_id || !$mb_pwd){
    echo "<script>alert('회원아이디나 비밀번호가 공백이면 안됩니다.');</script>";
    if($mode == "user"){
        //echo "<script>location.replace('./login.php');</script>";
    }
    else{
        echo "<script>location.replace('./admin/index.php');</script>";
    }
    exit;
}

$sql = "SELECT * FROM member where mb_id='$mb_id'";
$result = mysqli_query($conn, $sql);
$record = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if($record != 0){
    if($mb_id !== $row['mb_id'] || $mb_pwd !== $row['mb_pwd'])//로그인을 성공하지 못한 경우
    {
        echo "<script>alert('아이디 또는 비밀번호가 틀립니다.');</script>";
        if($mode == "user"){
            echo "<script>location.replace('./login.php');</script>";
        }
        else{
            echo "<script>location.replace('./admin/index.php');</script>";
        }
        exit;
    }
}else{
    echo "<script>alert('존재하지 않는 아이디입니다.');</script>";
    echo "<script>location.replace('./login.php');</script>";
}

 //로그인을 성공한 이후~
$_SESSION['ss_mb_id'] = $mb_id;
mysqli_close($conn);
if(isset($_SESSION['ss_mb_id']))//세션이 있다면 로그인 확인 페이지로 이동
{
    echo "<script>alert('로그인 되었습니다.');</script>";
    if($mode == "user"){
        echo "<script>location.replace('./product.php?menu=ice');</script>";
    }
    else{
        echo "<script>location.replace('./admin/sales_rate.php');</script>";
    }
}
?>