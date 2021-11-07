<?php
include("./dbconn.php");
include("./function.php");

$mb_id = $_SESSION['ss_mb_id'];
$total_price = 0;
$order_amount = 0;
if($_POST['buy_option'] == "direct"){
    if($_POST['p_category'] == "ice"){
        $p_category=trim($_POST['p_category']);
        $buy = 1;
        $p_id = $_POST['p_id'];
        $amount = $_POST['amount'];
        $sql = "SELECT * FROM product where p_id = '$p_id'";
        $result = mysqli_query($conn, $sql);
        $p_row = mysqli_fetch_array($result);
        $total_price = $p_row['p_price'] * $amount;
        $order_amount=1;
    }
    else{
        $p_category=trim($_POST['p_category']);
        $buy = 1;
        $p_id = $_POST['p_id'];
        $sql = "SELECT * FROM product where p_id = '$p_id'";
        $result = mysqli_query($conn, $sql);
        $p_row = mysqli_fetch_array($result);
        $flavorArr = $_POST['flavor'];
        $total_price = $p_row['p_price'];
        $order_amount=1;
    }
}
else if($_POST['buy_option']=="basket_all"){//전체 구매 시
    $buy = 2;
    $sql = "SELECT * FROM basket where mb_id = '".$mb_id."'";
    $result = mysqli_query($conn, $sql);
    $order_amount = mysqli_num_rows($result);
    $sql = "SELECT * FROM basket join product on basket.p_id = product.p_id where mb_id = '".$mb_id."'";
    $result = mysqli_query($conn, $sql);
    $i=0;
    while($b_row = mysqli_fetch_array($result)) {
        $amountArr[$i]=$b_row['amount'];
        $p_nameArr[$i]=$b_row['p_name'];
        $b_idArr[$i]=$b_row['b_id'];
        $price = $amountArr[$i] * $b_row['p_price'];
        $total_price += $price;
        $i++;
    }
}
else {//선택 구매시
    if(!isset($_POST['chk'])){
        echo "<script>alert('적어도 하나를 선택해주세요');</script>";
        echo "<script>location.replace('./basket_list.php');</script>";
    }
    $buy = 3;
    $order_amount=sizeof($proArr);
    for ($i=0;$i<$order_amount;$i++) {
        $b_id=$proArr[$i];
        $sql = "SELECT * FROM basket join product on basket.p_id = product.p_id where b_id = '".$b_id."'";
        $result = mysqli_query($conn, $sql);
        $b_row = mysqli_fetch_array($result);
        $amountArr[$i]=$b_row['amount'];
        $p_nameArr[$i]=$b_row['p_name'];
        $b_idArr[$i]=$b_row['b_id'];
        $price = $amountArr[$i] * $b_row['p_price'];
        $total_price += $price;
    }
}
$sql = "SELECT * FROM member where mb_id = '$mb_id'";
$result = mysqli_query($conn, $sql);
$mb_row = mysqli_fetch_array($result);
switch($date_num){
    case 0:
    case 1:
    case 2:
    case 3:
        $ship_date = date("n월 j일", strtotime($current_date1."+3 days"));break;
    default:
        $ship_date = date("n월 j일", strtotime($current_date1."+4 days"));
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="./js/address.js"></script>
    <script src="./js/content_hide.js"></script>
    <script src="js/checkbox_one_select.js?ver1"></script>
    <title>Document</title>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="top">
            <div class="logo_image">
                <a href="./index.php"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="top_text">
                <p class="titleText">주문/결제</p>
                <p class="titleText2">
                    <span style="color: #0054FF;">주문 결제<i class="fas fa-chevron-right" style="margin-left:10px; color:#0054FF;"></i></span>
                    <span style="color: #a6a6a6; margin-left:5px;">결제 확인<i class="fas fa-chevron-right" style="margin-left:10px; color:#a6a6a6;"></i></span>
                    <span style="color:#a6a6a6; margin-left:5px;">주문 완료</span>
                </p>
            </div>
            <div class="order_information">
                <p class="text1">구매자 정보</p>
                <table>
                    <tr>
                        <td class="col1">이름</td>
                        <td class="col2"><?php echo $mb_row['mb_name']?></td>
                    </tr>
                    <tr>
                        <td class="col1">이메일</td>
                        <td class="col2"><?php echo $mb_row['mb_email']?></td>
                    </tr>
                    <tr>
                        <td class="col1">휴대전화</td>
                        <td class="col2"><?php echo $mb_row['mb_phone'];?></td>
                    </tr>
                </table>
            </div>
            <form action="./order_update.php" method="post">
            <div class="order_information">
                <p class="chk_recipient"><span class="text1">받는사람 정보</span><input type="checkbox" id="check_box" name="chk_info" value="different"><span style="color:#8C8C8C;">(구매자와 다르다면 누르세요)</span></p>
                <div id="same_info">
                <table>
                    <input type="hidden" name="same_address" value="<?php echo $mb_row['mb_address'];?>">
                    <input type="hidden" name="mb_name" value="<?php echo $mb_row['mb_name'];?>">
                    <input type="hidden" name="mb_phone" value="<?php echo $mb_row['mb_phone'];?>">
                    <tr>
                        <td class="col1">이름</td>
                        <td class="col2"><?php echo $mb_row['mb_name'];?></td>
                    </tr>
                    <tr>
                        <td class="col1">배송 주소</td><!--배송 주소 바뀌게 버튼-->
                        <td class="col2"><?php echo $mb_row['mb_address'];?></td>
                    </tr>
                    <tr>
                        <td class="col1">연락처</td>
                        <td class="col2"><?php echo $mb_row['mb_phone'];?></td>
                    </tr>
                    <tr>
                        <td class="col3"><i class="fas fa-check" style="color: #FF0000; margin-right:5px;"></i>배송 요청사항</td>
                        <td class="col4"><input type="text" name="ship_request1"></td>
                    </tr>
                </table>
                </div>
                <div id="different_info">
                <table>
                    <tr>
                        <td class="col1">이름</td>
                        <td class="col2"><input type="text" name="recipient_name"></td>
                    </tr>
                    <tr>
                        <td class="col3">배송 주소</td><!--배송 주소 바뀌게 버튼-->
                        <td class="col4">
                            <input type="text" id="sample6_postcode" name= "recipient_postcode" placeholder="우편번호">
                            <input type="button" class="but2" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                            <input type="text" id="sample6_address" name = "recipient_address" placeholder="주소"><br>
                            <input type="text" id="sample6_detailAddress" name = "recipient_detailAddress" placeholder="상세주소">
                            <input type="text" id="sample6_extraAddress" placeholder="참고항목">
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">연락처</td>
                        <td class="col2"><input type="text" name="recipient_phone"></td>
                    </tr>
                    <tr>
                        <td class="col1"><i class="fas fa-check" style="color: #FF0000; margin-right:5px;"></i>배송 요청사항</td>
                        <td class="col2"><input type="text" name="ship_request2"></td>
                    </tr>
                </table>
                </div>
            </div>
            <div class="order_information">
                <p class="text1"><?php echo "배송 ".$order_amount."건";?></p>
                <table style="border: 1px solid #A6A6A6;">
                    <tr>
                        <td class="col5"><?php echo $ship_date;?> 도착 예정</td>
                    </tr>
                        <?php
                            if($buy==1){ 
                                if($_POST['p_category'] == "ice" || $_POST['p_category'] =="beverage"){?>
                            <tr>
                            <input type="hidden" name="buy" value="1">
                            <input type="hidden" name="p_category" value="<?php echo $p_category;?>">
                            <input type="hidden" name="p_id" value="<?php echo $p_id;?>">
                            <input type="hidden" name="amount" value="<?php echo $amount;?>">
                            <td class="col2" style="border-bottom:none;">
                            <p class="text2"><?php echo $p_row['p_name'];?></p>
                            <p class="text3">,</p>
                            <p class="text4"><?php echo $amount."개";?></p>
                            </td></tr>
                            <?php }else{
                                for ($i=0;$i<sizeof($flavorArr);$i++) {
                                    $flavorArr_pid=$flavorArr[$i];
                                    $sql4 = "SELECT * FROM product where p_id = '$flavorArr_pid'";
                                    $result4 = mysqli_query($conn, $sql4);
                                    $p_row_ = mysqli_fetch_array($result4);
                            ?>
                            <tr>
                                <input type="hidden" name="buy" value="1">
                                <input type="hidden" name="p_id" value="<?php echo $p_id;?>">
                                <input type="hidden" name="p_category" value="<?php echo $p_category;?>">
                                <input type="hidden" name="select_flavor[]" value="<?php echo $flavorArr[$i];?>">
                                <td class="col2">
                                    <p class="text2"><?php echo $p_row_['p_name'];?></p>
                                </td>
                            </tr>
                            <?php }
                                }
                            }
                            else{
                                for ($i=0;$i<$order_amount;$i++) {
                                    ?>
                                    <tr>
                                    <td class="col2">
                                    <input type="hidden" name="buy" value="2">
                                    <input type="hidden" name="select_product[]" value="<?php echo $b_idArr[$i];?>">
                                    <p class="text2"><?php echo $p_nameArr[$i].","?></p>
                                    <p class="text3"><?php echo $amountArr[$i]."개";?></p>
                                    </td></tr>
                                    <?php
                                }
                            }
                        ?>
                </table>
            </div>
            <div class="order_information">
                <p class="text1">결제 정보</p>
                <table>
                    <tr>
                        <td class="col1">총 상품가격</td>
                        <td class="col2"><?php echo $total_price."원";?></td>
                    </tr>
                    <tr>
                        <td class="col1">할인 쿠폰</td>
                        <td class="col2"></td>
                    </tr>
                    <tr>
                        <td class="col1">배송비</td>
                        <td class="col2">
                            <?php
                            if($total_price >= 50000){
                                echo "0원";
                            }
                            else{
                                $total_price += 2500;
                                echo "2500원";?>
                                <span style="margin-left:10px;color:#a6a6a6; font-size:0.9em;">(50000원 이상시 배송비 무료)</span>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">총 결제금액</td>
                        <td class="col2"><?php echo $total_price."원";?></td>
                    </tr>
                    <tr>
                        <td class="col3">결제 방법</td>
                        <td class="col4">
                            <ul>
                                <li><input type="checkbox" name="payment" value="kakaopay" onclick='checkOnlyOne(this)'><span style="margin-left:10px;"><img class="payment_logo" src="./img/kakao_pay.png" alt="">카카오페이</span></li>
                                <li><input type="checkbox" name="payment" value="account_transfer" onclick='checkOnlyOne(this)'><span style="margin-left:10px;">계좌이체</span></li>
                                <li><input type="checkbox" name="payment" value="credit_card" onclick='checkOnlyOne(this)'><span style="margin-left:10px;">신용/체크 카드</span></li>
                                <li><input type="checkbox" name="payment" value="corporation_card" onclick='checkOnlyOne(this)'><span style="margin-left:10px;">법인카드</span></li>
                                <li><input type="checkbox" name="payment" value="phone" onclick='checkOnlyOne(this)'><span style="margin-left:10px;">휴대폰</span></li>
                                <li><input type="checkbox" name="payment" value="despositor" onclick='checkOnlyOne(this)'><span style="margin-left:10px;">무통장 입금</span></li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="btn_area">
                <input type="submit" class="btn1" value="결제하기">
            </div>
            <?php mysqli_close($conn);?>
                </form>
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