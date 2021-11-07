<?php
include("./dbconn.php");
include("./function.php");

$mb_id = $_SESSION['ss_mb_id'];
$total_price = 0;
$over_count = 0;

if($_POST['buy']=="1"){
    $p_id=$_POST['p_id'];
    $amount=$_POST['amount'];
    $sql2 = "SELECT * FROM product where p_id = '".$p_id."'";
    $result = mysqli_query($conn, $sql2);
    $p_row = mysqli_fetch_array($result);

    $p_amount = $p_row['p_amount'] - $amount;
    if($p_amount < 0 ){
        echo "<script>alert('수량이 부족합니다. 구매하실 수 없습니다.');</script>";
        echo "<script>location.replace('./product.php?menu=ice');</script>";
        $over_count += 1;
    }
}
else{
    $b_idArr = $_POST['select_product'];
    for ($i=0;$i<sizeof($b_idArr);$i++) {
        $sql2 = "SELECT * FROM basket join product on basket.p_id = product.p_id where b_id = '".$b_idArr[$i]."'";
        $result = mysqli_query($conn, $sql2);
        $b_row = mysqli_fetch_array($result);
        $p_amount=$b_row['p_amount'] - $b_row['amount'];
        if($p_amount < 0 ){
            echo "<script>alert('수량이 부족합니다. 구매하실 수 없습니다.');</script>";
            echo "<script>location.replace('./product.php?menu=ice');</script>";
            $over_count += 1;
        }
    }

}


if(isset($_POST['chk_info'])){
    //different일때
    $final_address = trim($_POST['recipient_address'])." ".trim($_POST['recipient_detailAddress']);
    $recipient_name=trim($_POST['recipient_name']);
    $recipient_phone=trim($_POST['recipient_phone']);
    $ship_request = trim($_POST['ship_request2']);
}
else {
    $recipient_name=trim($_POST['mb_name']);
    $recipient_phone=trim($_POST['mb_phone']);
    $final_address = trim($_POST['same_address']);
    $ship_request = trim($_POST['ship_request1']);
}
if($over_count == 0){
    //수량이 0이 아니면
    $o_date = date("Y-m-d");
    $o_state="결제완료";
    $payment = $_POST['payment'];
    $sql = "SELECT max(o_id) FROM orders";
    $result = mysqli_query($conn, $sql);
    $order = mysqli_fetch_array($result);
    $o_id=$order[0]+1;
    
    $sql2 = " INSERT INTO orders
    SET o_id = '$o_id', 
    mb_id = '$mb_id',
    o_date = '$o_date',
    o_state='$o_state',
    payment = '$payment'
    ";
    $result = mysqli_query($conn, $sql2);
    $sql3 = " INSERT INTO recipient
    SET o_id = '$o_id', 
    recipient = '$recipient_name',
    final_address = '$final_address',
    recipient_phone = '$recipient_phone',
    ship_request = '$ship_request'
    ";
    $result3 = mysqli_query($conn, $sql3);
    if($_POST['buy']=="1"){
        //직접구매일때
        $price=$p_row['p_price']*$amount;
        $total_price = $price;
            
        $sql3 = " INSERT INTO order_detail
                    SET o_id = '$o_id',
                    p_id = '$p_id',
                    o_amount = '$amount',
                    o_price = '$price'
                    ";
        $result = mysqli_query($conn, $sql3);
        $sql4="UPDATE product set p_amount= '$p_amount' where p_id='$p_id'";
        $result4 = mysqli_query($conn, $sql4);
    }
    else{
        $b_idArr = $_POST['select_product'];
        $total_price = 0;
        for ($i=0;$i<sizeof($b_idArr);$i++) {
            $sql2 = "SELECT * FROM basket join product on basket.p_id = product.p_id where b_id = '".$b_idArr[$i]."'";
            $result = mysqli_query($conn, $sql2);
            $b_row = mysqli_fetch_array($result);
            $p_id=$b_row['p_id'];
            $amount=$b_row['amount'];
            $price=$amount*$b_row['p_price'];
            $total_price = $total_price + $price;
            
            $sql3 = " INSERT INTO order_detail
                    SET o_id = '$o_id',
                    p_id = '$p_id',
                    o_amount = '$amount',
                    o_price = '$price'
                    ";
            $result = mysqli_query($conn, $sql3);
            $sql4 = "DELETE FROM basket where b_id = '".$b_idArr[$i]."'";
            $result = mysqli_query($conn, $sql4);
         }
    }
}

?>


<?php
if($total_price < 50000){
    $total_price += 2500;
}
if($payment == "kakaopay"){
    $mb_id = $_SESSION['ss_mb_id'];
    $sql1="SELECT mb_name from member where mb_id='$mb_id'";
    $result1 = mysqli_query($conn, $sql1);
    $row= mysqli_fetch_array($result1);
    ?>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order.css?after">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
    <script src="./js/kakaopay.js"></script>
    <title>Document</title>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="top">
            <div class="logo_image">
                <a href=""><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="payment_state_txt_wrap">
                <p class="titleText2">
                    <span style="color: #a6a6a6;">주문 결제<i class="fas fa-chevron-right" style="margin-left:10px; color:#a6a6a6;"></i></span>
                    <span style="color: #0054FF; margin-left:5px;">결제 확인<i class="fas fa-chevron-right" style="margin-left:10px; color:#0054FF;"></i></span>
                    <span style="color:#a6a6a6; margin-left:5px;">주문 완료</span>
                </p>
            </div>
            <div class="payment_confirmation">
                <p class="titleText3">결제정보 확인</p>
                <table class="payment_confirmation_table">
                    <tr>
                        <td class="col6">구매자</td>
                        <td class="col7"><?php echo $row['mb_name'];?></td>
                    </tr>
                    <tr>
                        <td class="col6">결제수단</td>
                        <td class="col7">카카오페이</td>
                    </tr>
                    <!--
                        <?php /* ?>
                    <tr>
                        <td class="col6">주문 내역</td>
                        <td class="col7">
                            <?php
                                if($_POST['buy']=="1"){
                                    ?>
                                    <ul>
                                        <li><?php echo $p_row['p_name'].",";?><span class="amount_txt"><?php echo $amount;?>개,</span><span class="price_txt"><?php echo $p_row['p_price'];?>원</span></li>
                                    </ul>
                                    <?php
                                }
                                else{
                                    ?>
                                    <ul class="order_list">
                                        <?php for ($i=0;$i<sizeof($b_idArr);$i++) {
                                            $sql2 = "SELECT * FROM basket join product on basket.p_id = product.p_id where b_id = '".$b_idArr[$i]."'";
                                            $result = mysqli_query($conn, $sql2);
                                            $b_row = mysqli_fetch_array($result);
                                            $p_name=$b_row['p_name'];
                                            $amount=$b_row['amount'];
                                            $price=$amount*$b_row['p_price'];
                                            ?>
                                        <li><?php echo $p_name.",";?><span class="amount_txt"><?php echo $amount;?>개,</span><span class="price_txt"><?php echo $price;?>원</span></li>
                                        <?php }?>
                                    </ul>
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php */ ?>
                    !-->
                    <tr>
                        <td class="col6">총 결제금액</td>
                        <td class="col7"><?php echo $total_price;?>원</td>
                    </tr>
                </table>
                <div class="kakaopay_btn_wrap">
                    <input type="hidden" name="oid" id="oid" value="<?php echo $o_id;?>">
                    <button class="kakaopay_btn" onclick="requestPay()">결제하기</button>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div>OH MY ICE</div>
        <div>
              사업자 등록번호 : 303-81-09535 비알코리아(주) 대표이사 도세호 서울특별시 서초구 남부순환로 2620(양재동 11-149번지)
                TEL : 080-555-3131 <br>
                개인정보관리책임자 : 김경우 <br>
              COPYRIGHT 2019. TAMO. ALL RIGHT RESERVED.
        </div>
    </div>
</div>
</body>
</html>
<?php }
else{
    echo "<script>location.replace('./order_complete.php?o_id=$o_id');</script>";    
}
mysqli_close($conn);
?>