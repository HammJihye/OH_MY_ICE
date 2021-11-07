<?php

include("./dbconn.php");
include("./cookie.php");

if(isset($_GET['product'])){
    $p_id = $_GET['product'];
}
$sql = "SELECT * FROM product where p_id = '$p_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$name = $row['p_name'];

if(isset($_COOKIE['today_view'])){
    $today = explode(",", $_COOKIE["today_view"]);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/product_detail.css">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/dropdown.js"></script>
    <script src="js/float.js"></script>
    <script src="js/buy_quantity.js"></script>
    <title>PRODUCT</title>
</head>
<?php
?>
<body onload="init();">
<div class="wrap">
    <div class="header">
        <div class="top">
            <div class="logo_image">
                <a href=""><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
            <ul class="logo_nav">
                <li><a href="./product.php?menu=ice">PRODUCT</a></li>
                <!-- 로그인했으면 다르게-->
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="./login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./register.php">JOIN</a></li>
                <?php } else {?>
                <li><a href="./logout.php">LOG OUT</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./mypage/mypage.php">MY PAGE</a></li>
                <?php } ?>
                <form action="./result.php">
                <div class="search">
                    <div class="search-box">
                        <input type="text" class="search-txt" name="search_word" placeholder="Type to search">
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
                            <a href="./product.php?menu=ice"><li>ICE CREAM</li></a>
                            <a href="./product.php?menu=beverage"><li>DRINK</li></a>
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
                                <a href="./store/customer_center.php"><li>고객센터</li></a>
                                <a href="./store/faq.php"><li>FAQ</li></a>
                                <a href="./store/ask.php"><li>문의하기</li></a>
                            </ul>
                    </li>				
                    <li>ABOUT
                        <ul>
                            <li><a href="./about/notice.php">공지사항</a></li>
                            <li><a href="./about/contact_us.php">CONTACT US</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="section1">
            <img class="img1" src="./img/detail_img/<?php echo $row['p_id'];?>.jpg" alt="">
        </div>
        <div class="section2">
            <h1 class="titletext"><?php echo $row['p_name']; ?></h1>
            <div class="detail_box">
                <table>
                    <tr>
                        <td class="col1">구성</td>
                        <td>[OH MY ICE]  <?php echo $row['p_name'];?></td>
                    </tr>
                    <tr>
                        <td class="col1">판매가</td>
                        <td><?php echo $row['p_price'];?></td>
                    </tr>
                    <tr>
                        <td class="col1">교환처</td>
                        <td>OH MY ICE</td>
                    </tr>
                    <tr>
                        <td class="col1">적립금</td>
                        <td>0p</td>
                    </tr>
                    <tr>
                        <?php if($row['category'] == "ice_variety") {?>
                        <td class="col1">맛 선택</td>
                        <?php }else {?>
                        <td class="col1">구매수량</td>
                        <?php }?>
                        <td>
                        <form action="./order.php" method="post">
                        <?php if($row['category'] == "ice_variety")  {
                        ?>
                        <input type="hidden" name="buy_option" value="direct">
                        <input type="hidden" name="p_category" value="<?php echo $row['category'];?>">
                        <?php
                                if($p_id == 29){
                                    for($i = 0; $i <3 ; $i++){
                                    ?>
                                    <select name="flavor[<?php echo $i?>]" id="">
                                    <?php 
                                    $sql2 = "SELECT * FROM product where category = 'ice'";
                                    $result2 = mysqli_query($conn, $sql2);
                                    while($p_row = mysqli_fetch_array($result2)) {?>
                                        <option value="<?php echo $p_row['p_id'];?>"><?php echo $p_row['p_name'];?></option>
                                    <?php } ?>
                                    </select>
                                    <?php
                                    }
                                }    
                        ?>
                        <?php } else {?>
                        <input type="hidden" name="p_category" value="<?php echo $row['category'];?>">
                        <div class="__count_range">
                            <input type="hidden" name="p_id" value="<?php echo $p_id;?>">
                            <input type="hidden" name="buy_option" value="direct">
                            <input value="-" class="plus_btn" count_range="m" type="button">
                            <input class="count" value="1" readonly="" name="amount">
                            <input value="+" class="minus_btn" count_range="p" type="button">
                        </div>
                        <?php }?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="button_box">
                <?php if(isset($_SESSION['ss_mb_id'])){?>
                <input type="hidden" name="p_id" value="<?php echo $p_id;?>">
                <input class="btn1" type="submit" name="buy" value="구매하기">
                <input class="btn2" type="button" name="basket" value="장바구니" onclick='return submit2(this.form);'>
                <button class="btn3" type="button"><i class="far fa-heart fa-2x" style="color:red;"></i></button>
                <?php } else {?>
                <button type="button" class="btn1" onclick="id_check();">구매하기</button>
                <button type="button" class="btn2" onclick="id_check();">장바구니</button>
                <button type="button" class="btn3" onclick="id_check();"><i class="far fa-heart fa-2x" style="color:red;"></i></button>
                <?php } ?>
            </div>
            </form>
        </div>
        <div class="section3">
            <div id="floatMenu">
                <div class="text1">
                    최근 본 상품
                </div>
                <?php
                if(isset($_COOKIE['today_view'])){
                    $today = explode(",", $_COOKIE["today_view"]);
                    $arrayCount=count($today);
                    for($i=0; $i<5 && $i<$arrayCount;  $i++){
                        $p_sql = "SELECT * from product where p_id = '".$today[$i]."'";
                        $p_result = mysqli_query($conn, $p_sql);
                        $p_row = mysqli_fetch_array($p_result);
                ?>
                    <ul class="view_box">
                        <li><a href="./product_detail.php?product=<?php echo $p_row['p_id'];?>"><img class="img3" src="<?php echo $p_row['img_path'].$p_row['p_id']?>.jpg" alt=""></a></li>
                    </ul>
                <?php
                }}   
                ?>
            </div>
        </div>
        <hr>
        <div>
            <img class="img2" src="./img/detail_img1.jpg" alt="">
        </div>
        <div class="section4">
            <div>
                <ul class="menu-wrap">
                    <li><a class="selectedbox" href="#information">상품정보</a></li>
                    <li><a id="information" href="#guide">이용안내</a></li>
                    <li><a href="#notice">주의사항</a></li>
                </ul>
                <div class="content_box">
                    <ul class="content_list">
                        <li>[제품명]</li>
                        <li><?php echo $row['p_name'];?></li>
                    </ul>
                    <ul class="content_list">
                        <li>[이용안내]</li>
                        <li>- 본 상품은 예시 이미지로서 실제 상품과 다를 수 있습니다.</li>
                        <li>- 물품형 상품권은 상품명에 기재된 물품으로 교환됩니다.</li>
                        <li>- 동일상품 교환이 불가한 경우 쿠폰가격 이상의 다른상품으로 교환 가능하며, 초과금액은 추가 지불하여야 합니다.</li>
                        <li>- 일부 매장에서는 사용이 제한될 수 있습니다.</li>
                    </ul>
                    <ul class="content_list">
                        <li>[할인/적립/해피오더 사용 안내]</li>
                        <li>- 제휴카드 할인/매장 할인행사/온라인쿠폰 중복적용 불가합니다.</li>
                        <li>- 해피오더 사용 등은 교환처의 정책에 따릅니다.</li>
                    </ul>
                    <ul class="content_list">
                        <li>[이용 가능 매장]</li>
                        <li>- OH MY ICE에서 사용 가능합니다.</li>
                        <li>- 일부 매장은 사용 불가하며, 방문 전 사전 문의 부탁드립니다.</li>
                        <li>- 인천공항, 백화점, 고속도로 휴게소 등의 특수 매장에서는 사용이 제한될 수 있습니다.</li>
                    </ul>
                </div>
            </div>
            <div>
                <ul class="menu-wrap">
                    <li><a href="#information">상품정보</a></li>
                    <li><a id="guide" class="selectedbox" href="#guide">이용안내</a></li>
                    <li><a href="#notice">주의사항</a></li>
                </ul>
                <div class="content_box">
                    <ul class="content_list">
                        <li>[OH MY ICE] <?php echo $row['p_name'];?></li>
                    </ul>
                    <ul class="content_list">
                        <li>발행자: 주식회사 섹타나인</li>
                    </ul>
                    <ul class="content_list">
                        <li>문의전화: 해피콘 고객센터 1599-2799(상담시간: 평일 09시~18시, 공휴일 제외) </li>
                    </ul>
                    <ul class="content_list">
                        <li>▷오프라인 매장 및 해피오더에서도 사용 가능합니다. </li>
                        <li> 픽업, 배달 모두 가능하며 일부 교환권(행사 구매 제품 등)에 대해 사용이 제한될 수 있습니다. .</li>
                        <li> (https://www.happyorder.co.kr) </li>
                    </ul>
                </div>
            </div>
            <div>
                <ul class="menu-wrap">
                    <li><a href="#information">상품정보</a></li>
                    <li><a id="notice" href="#guide">이용안내</a></li>
                    <li><a class="selectedbox" href="#notice">주의사항</a></li>
                </ul>
                <div class="content_box">
                    <ul class="content_list">
                        <li>[OH MY ICE] <?php echo $row['p_name'];?></li>
                    </ul>
                    <ul class="content_list">
                        <li>* 본 상품은 예시 이미지로써 실제 상품과 다를 수 있습니다. </li>
                        <li>* 백화점 및 고속도로 휴게소 등의 특수매장에서는 사용이 제한될 수 있습니다.</li>
                        <li>* 물품형 상품권은 상품명에 기재된 물품으로 교환됩니다. </li>
                        <li>* 포인트 적립 및 제휴카드 할인 등은 교환처의 정책에 따릅니다.</li>
                        <li>* 본 상품은 별도의 지급보증 및 피해보상 보험계약체결 없이 자체 신용으로 발행되었습니다.</li>
                        <li>* 수신자는 고객센터를 통해 교환권의 수신거절을 요청할 수 있으며, 이 경우 구매자에게 수신거절에 대한 안내가 이루어집니다.</li>
                    </ul>
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
<script>
    function submit2(frm) { 
    frm.action='./basket_update.php'; 
    frm.submit(); 
    return true; 
  }
function id_check(){
    alert("로그인 해주세요");
    window.location.href='./login.php';
}
</script>
</html>