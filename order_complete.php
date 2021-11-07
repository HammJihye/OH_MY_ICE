<?php
include("./dbconn.php");
$o_id=$_GET['o_id'];
$sql = "SELECT * FROM orders where o_id = '$o_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/basic.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/dropdown.js"></script>
    <title>Document</title>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="top">
            <div class="logo_image">
                <a href="./index.php"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
            <ul class="logo_nav">
                <li><a href="inedex.html">HOME</a></li>
                <li><a href="product.html">PRODUCT</a></li>
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="./login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./register.php">JOIN</a></li>
                <?php } else {?>
                <li><a href="./logout.php">LOG OUT</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./mypage/mypage.php">MY PAGE</a></li>
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
        <div class="section">
                <div class="text_area">
                    <p class="title_text1">주문완료</p>
                </div>
                <div class="payment_state_txt_wrap">
                    <p class="titleText4">
                        <span style="color: #a6a6a6;">주문 결제<i class="fas fa-chevron-right" style="margin-left:10px; color:#a6a6a6;"></i></span>
                        <span style="color: #a6a6a6; margin-left:5px;">결제 확인<i class="fas fa-chevron-right" style="margin-left:10px; color:#a6a6a6;"></i></span>
                        <span style="color:#0054FF; margin-left:5px;">주문 완료</span>
                    </p>
                </div>
                <div class="msg_area">
                    <div class="icon_area">
                        <i class="fas fa-shopping-basket fa-8x" style="float:left;"></i>
                        <div class="order_brief_info">
                            <p class="text1">주문번호:<?php echo $o_id;?></p>
                            <p class="text1">주문날짜:<?php echo $row['o_date'];?></p>
                        </div>
                    </div>
                    <p class="text2">고객님의 주문이 완료되었습니다.</p>
                    <p class="text3">주문내역에 관한 상세사항을 보시려면 마이페이지에서 확인하실 수 있습니다.</p>
                </div>
                <div class="btn_area">
                    <button class="btn1" onClick="location.href='./product.php?menu=ice'">상품페이지로</button>
                    <button class="btn1" onClick="location.href='./mypage/mypage.php'">주문상세</button>
                </div>
        </div>
    </div>
    <div class="footer">
            <div>LOGO</div>
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