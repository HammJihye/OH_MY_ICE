<?php

include("../dbconn.php");
include("../function.php");

$o_id=$_GET['o_id'];
$sql = "SELECT * from order_detail as od join product as p on od.p_id=p.p_id where o_id = '".$o_id."'";
$result = mysqli_query($conn,$sql);
$sql2 = "SELECT * , sum(o_price) as total_price, sum(o_amount) as total_amount from orders as o join order_detail as od on o.o_id=od.o_id where o.o_id = '".$o_id."'";
$result2 = mysqli_query($conn,$sql2);
$o_row= mysqli_fetch_array($result2);
$payment1=$o_row['payment'];
$total_price=$o_row['total_price'];
if($total_price <50000){
    $final_total_price = $total_price +2500;
}
else{
    $final_total_price = $total_price;
}
$o_state = $o_row['o_state'];
switch($payment1){
    case "kakaopay" : $payment="카카오페이";break;
    case "account_transfer" : $payment="계좌이체";break;
    case "credit_card" : $payment="신용카드";break;
    case "corporation_card" : $payment="법인카드";break;
    case "phone" : $payment="핸드폰 결제";break;
    case "despositor" : $payment="무통장 입금";break;
}
$i=0;
$sql3 = "SELECT * from recipient where  o_id = '".$o_id."'";
$result3 = mysqli_query($conn,$sql3);
$r_row= mysqli_fetch_array($result3);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mypage.css?after">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/dropdown.js"></script>
    <script src="../js/address.js"></script>
    <title>Document</title>
</head>
<style>
    .btn_area a,b {
        margin-left:20px;
    }
</style>
<body>
<div class="wrap">
    <div class="header">
        <div class="top">
            <div class="logo_image">
                <a href="../index.php"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
            <ul class="logo_nav">
                <li><a href="../inedex.php">HOME</a></li>
                <li><a href="../product.php?menu=ice">PRODUCT</a></li>
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="../login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="../register.php">JOIN</a></li>
                <?php } else { ?>
                        <li><a href="../logout.php">LOG OUT</a></li>
                        <li><a href="./mypage.php">MY PAGE</a></li>
               <?php } ?>
                <form action="result.php">
                <div class="search">
                    <div class="search-box">
                        <input type="text" class="search-txt" name="test1" placeholder="Type to search">
                        <input type="submit" class="search-btn" value="&#xf002;">
                    </div>
                </div>
                </form>
                </li>
            </ul>
        </div>
        <div id="dropdown_menu">
            <nav>
                <ul class="clearfix">
                    <li>MENU
                        <ul>
                            <a href="../product.php?menu=ice"><li>ICE CREAM</li></a>
                            <a href="../product.php?menu=beverage"><li>DRINK</li></a>
                        </ul>
                    </li>
                    <li>영양성분 및 알레르기
                        <ul>
                            <li>ICE CREAM</li>
                            <li>DRINK</li>
                            <li>COFFEE</li>
                        </ul>
                    </li>
                    <li>EVENT
                        <ul>
                            <li>진행중인 이벤트</li>
                            <li>당첨자 발표</li>
                        </ul>
                    </li>
                    <li>STORE
                            <ul>
                                <a href="../store/customer_center.php"><li>고객센터</li></a>
                                <a href="../store/faq.php"><li>FAQ</li></a>
                                <a href="../store/ask.php"><li>문의하기</li></a>
                            </ul>
                    </li>				
                    <li>ABOUT
                        <ul>
                            <li><a href="../notice.php">공지사항</a></li>
                            <li>QNA</li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
            <div class="mainContent">
                <h1 class="titleText1">주문 상세 보기</h1>
                <div class="section">
                    <div class="order_detail">
                        <form action="../update.php" method="post">
                        <input type="hidden" name="request" value="delete">
                        <input type="hidden" name="o_id" value="<?php echo $o_id;?>">
                        <div class="order_detail_list">
                            <p class="text4">주문 상품 <span style="margin-left:10px;color:#0054FF; font-size:0.7em;">주문일자(<?php echo $o_row['o_date'];?>)</span></p>
                            <table class="order_detail_table">
                                <tr class="order_col1"><th>상품</th><th>상품명</th><th>수량</th><th>상품금액</th><th>주문상태</th><th>배송비</th></tr>
                                <?php while($od_row = mysqli_fetch_array($result)) {
                                    $cate=$od_row['category'];
                                    if($cate == "ice" || $cate == "beverage"){
                                ?>
                                <tr class="order_col2"><td><img class="order_detail_img_box" src="<?php echo ".".$od_row['img_path'].$od_row['p_id']?>.jpg" alt=""></td>
                                <td><?php echo $od_row['p_name'];?></td><td><?php echo $od_row['o_amount'];?></td>
                                <td><?php echo $od_row['o_price']."원";?></td><td></td><td></td>
                                </tr>
                                <?php }
                                    else{
                                        $total_price = $od_row['o_price'];
                                        if($total_price > 50000){
                                            $final_total_price = $total_price;
                                        }else{
                                            $final_total_price = $total_price +2500;
                                        }
                                        $od_id=$od_row['o_detail_id'];
                                        $sql5="SELECT * from order_detail as od join product as p on od.flavor=p.p_id where o_detail_id = '".$od_id."'";
                                        $result5 = mysqli_query($conn,$sql5);
                                        $od_row_= mysqli_fetch_array($result5);
                                ?>
                                        <tr class="order_col2"><td><img class="order_detail_img_box" src="<?php echo ".".$od_row_['img_path'].$od_row_['p_id']?>.jpg" alt=""></td>
                                        <td><?php echo $od_row['p_name']."(".$od_row_['p_name'].")";?></td>
                                        <td></td>
                                        <td></td><td></td><td></td>
                                        </tr>
                                <?php
                                    } 
                                    $i++;
                                }?>
                                <tr class="order_col3">
                                <?php if($cate == "ice") {?>
                                    <td colspan="2">합계</td>
                                    <td><?php echo $o_row['total_amount']."개";?></td>
                                    <td><?php echo $o_row['total_price']."원";?></td>
                                    <td><?php echo $o_row['o_state'];?></td>
                                    <?php if($o_row['total_price'] < 50000) {?>
                                    <td>2500원</td>
                                    <?php } else {?>
                                    <td>0원</td>
                                    <?php } ?>
                                <?php } else { ?>
                                    <td colspan="2">합계</td>
                                    <td>1개</td>
                                    <td><?php echo $o_row['o_price'];?>원</td>
                                    <td><?php echo $o_row['o_state'];?></td>
                                    <?php if($total_price < 50000) {?>
                                    <td>2500원</td>
                                    <?php } else {?>
                                    <td>0원</td>
                                    <?php } ?>
                                <?php } ?>
                                </tr>
                            </table>
                        </div>
                        <div class="order_detail_btn">
                            <input type="button" class="btn1" value="취소 요청" onclick="location.href='./request_form.php?o_id=<?php echo $o_id; ?>&request=cancle'">
                            <input type="button" class="btn1" value="환불 요청" onclick="location.href='./request_form.php?o_id=<?php echo $o_id; ?>&request=refund'">
                            <input type="button" class="btn1" value="반품 요청" onclick="location.href='./request_form.php?o_id=<?php echo $o_id; ?>&request=return'">
                            <input type="button" class="btn1" value="교환 요청" onclick="location.href='./request_form.php?o_id=<?php echo $o_id; ?>&request=exchange'">
                            <input type="submit" class="btn1" value="요청취소">
                        </div>
                        </form>
                        <?php if(isset($_GET['recipient'])){?>
                        <form action="../update.php" method="post">
                        <input type="hidden" name="o_id" value="<?php echo $o_id;?>">
                        <input type="hidden" name="recipient_info_update" value="y">
                        <div class="ship_information">
                            <p class="text4">배송지 정보</p>
                            <table class="ship_information_table">
                                <tr class="top_line">
                                    <td class="ship_col1">수령인</td>
                                    <td class="ship_col3"><input type="text" class="input_box4" name="recipient" value="<?php echo $r_row['recipient']?>"></td>
                                </tr>
                                <tr>
                                    <td class="ship_col1">배송지 주소</td>
                                    <td class="ship_col4">
                                        <input type="text" class="input_box5" id="sample6_postcode" name= "mb_postcode" placeholder="우편번호">
                                        <input type="button" class="btn7" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                                        <input type="text" class="input_box5" id="sample6_address" name = "mb_address" placeholder="주소"><br>
                                        <input type="text" class="input_box5" id="sample6_detailAddress" name = "mb_detailAddress" placeholder="상세주소">
                                        <input type="text" class="input_box5" id="sample6_extraAddress" placeholder="참고항목">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ship_col1">연락처</td>
                                    <td class="ship_col3"><input type="text" class="input_box4" name="recipient_phone" value="<?php echo $r_row['recipient_phone']?>"></td>
                                </tr>
                                <tr class="bottom_line">
                                    <td class="ship_col1">배송 메모</td>
                                    <td class="ship_col3">
                                    <?php if($r_row['ship_request'] == ""){ $ship_msg = ""; } else {
                                         $ship_msg=$r_row['ship_request'];}?>
                                        <input type="text" class="input_box4" name="ship_request" value="<?php echo $ship_msg;?>">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="ship_info_update_btn_wrap">
                            <input type="submit" class="btn1" value="변경하기">
                        </div>
                        </form>
                        <?php } else {?>
                            <div class="ship_information">
                            <p class="text4">배송지 정보</p>
                            <table class="ship_information_table">
                                <tr class="top_line">
                                    <td class="ship_col1">수령인</td>
                                    <td class="ship_col2"><?php echo $r_row['recipient']?></td>
                                </tr>
                                <tr>
                                    <td class="ship_col1">배송지 주소</td>
                                    <td class="ship_col2"><?php echo $r_row['final_address']?></td>
                                </tr>
                                <tr>
                                    <td class="ship_col1">연락처</td>
                                    <td class="ship_col2"><?php echo $r_row['recipient_phone']?></td>
                                </tr>
                                <tr class="bottom_line">
                                    <td class="ship_col1">배송 메모</td>
                                    <td class="ship_col2"><?php if($r_row['ship_request'] == ""){ echo "요청 사항이 없습니다.";} else {
                                         echo $r_row['ship_request'];}?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php }?>
                        <?php if($o_state == "결제완료" && !isset($_GET['recipient'])){?>
                        <div class="ship_info_update_btn_wrap">
                            <input type="button" class="btn1" value="변경하기" onclick="location.href='./order_detail_view.php?o_id=<?php echo $o_id;?>&recipient=update'" style="">
                        </div>
                        <?php }?>
                        <div class="payment_information">
                            <p class="text4">결제 정보</p>
                            <table class="payment_information_table">
                                <tr class="top_line">
                                    <td class="pay_col1">결제 방식</td>
                                    <td class="pay_col2"><?php echo $payment?></td>
                                </tr>
                                <tr>
                                    <td class="pay_col1">혜택</td>
                                    <td class="pay_col2">0원</td>
                                </tr>
                                <tr>
                                    <td class="pay_col1">결제 금액</td>
                                    <td class="pay_col2"><?php echo $final_total_price;?>
                                    원</td>
                                </tr>
                                <tr class="bottom_line">
                                    <td class="pay_col1">주문 상태</td>
                                    <td class="pay_col2"><?php echo $o_row['o_state'];?></td>
                                </tr>
                            </table>
                            <div class="total_price_box">
                                <ul class="specification">
                                    <li>상품금액 : <?php echo $total_price;?>원</li>
                                    <li>배송비 : <?php if($total_price <50000) {echo "(+)2500원";}
                                    else {echo "0원";}?></li>
                                    <li>할인 : 0원</li>
                                    <li>마일리지 사용 : 0원</li>
                                    <li>쿠폰 사용 : 0원</li>
                                </ul>
                                <p class="text5">총 합계 : <?php echo $final_total_price;?>원</p>
                            </div>
                        </div>
                        <div class="return_btn_area">
                            <button class="btn2" onClick="location.href='./mypage.php'" style="cursor: pointer;">이전 페이지로</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar">
                <div class="sidebar_logo_wrap">
                    <a href="./"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
                </div>
                <ul>
                    <li class="sidebarlist">
                        <p>MY 쇼핑</p>
                        <ul>
                            <li><a href="./mypage.php">주문목록/배송조회</a></li>
                            <li><a href="./basket_list.php">장바구니 목록조회</a></li>
                            <li><a href="./request_view.php">취소/반품/교환/환불내역</a></li>
                        </ul>
                    </li>
                    <li class="sidebarlist">
                        <p>MY 활동</p>
                        <ul>
                            <li><a href="./myasklist.php">문의내역</a></li>
                            <li><a href="">찜 리스트</a></li>
                        </ul>
                    </li>
                    <li class="sidebarlist">
                        <p>MY 정보</p>
                        <ul>
                            <li><a href="./myinfo/pwd_check.php?myinfo_cate=myinfo">회원정보 변경</a></li>
                            <li><a href="./myinfo/pwd_check.php?myinfo_cate=myaddress">나의 배송지 관리</a></li>
                            <li><a href="./myinfo/pwd_check.php?myinfo_cate=delete_account">회원 탈퇴</a></li>
                        </ul>
                    </li>
                </ul>
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
</div>
</body>
</html>