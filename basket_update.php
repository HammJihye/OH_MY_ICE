<?php

include("./dbconn.php");

if(isset($_SESSION['ss_mb_id'])){
    $mb_id = trim($_SESSION['ss_mb_id']);
}

if(isset($_POST['p_id']) && isset($_POST['amount'])){
    $p_id = trim($_POST['p_id']);
    $amount = trim($_POST['amount']);

    //중복확인
    $b_sql = "SELECT b_id, count(*) as b_count, amount FROM basket where p_id = '".$p_id."' and mb_id = '".$mb_id."' ";
    $b_result = mysqli_query($conn,$b_sql);
    $b_row = mysqli_fetch_array($b_result);//전체 칼럼

    if($b_row['b_count'] > 0){
        //장바구니 담은 상품 중복일 때
        $b_id = $b_row['b_id'];
        $b_amount = $amount + $b_row['amount'];
        $sql="UPDATE basket set amount='$b_amount' where b_id='$b_id'";
    }
    else{
        $sql = " INSERT INTO basket
                SET p_id = '$p_id',
                mb_id = '$mb_id',
                amount = '$amount'
                ";
    }
    $result = mysqli_query($conn, $sql);
}
$herf= './product_detail.php?product='.$p_id;
echo "<script>alert('장바구니에 담겼습니다.');</script>";
echo "<script>location.replace('$herf');</script>";
?>