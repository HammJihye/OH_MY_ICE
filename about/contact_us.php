<?php
include("../dbconn.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basic.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/dropdown.js"></script>
    <title>Document</title>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="top">
            <div class="logo_image">
                <a href=""><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
            <ul class="logo_nav">
                <li><a href="inedex.html">HOME</a></li>
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="../login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="../register.php">JOIN</a></li>
                <?php } else {?>
                <li><a href="../logout.php">LOG OUT</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="../mypage.php">MY PAGE</a></li>
                <?php } ?>
                <form action="../result.php">
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
                            <a href="../product.php?menu=ice"><li>ICE CREAM</li></a>
                            <a href="../product.php?menu=beverage"><li>DRINK</li></a>
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
                            <a href="./notice.php"><li>공지사항</li></a>
                            <a href="./contact_us.php"><li>CONTACT US</li></a>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="title_text_area" style="width: 340px;">
                <ul>
                    <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                    <li><p class="text4">CONTACT US</p></li>
                    <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                </ul>
            </div>
            <div class="map_wrap">
                <div id="map"></div>
                <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=5561068ff5f4300acc4c3b0a50abe0af"></script>
                <script type="text/javascript" src="../js/map.js"></script>
                <p class="text5" style="margin-top:50px;">오시는 방법</p>
                <ul class="direction_list">
                    <li class="text12">지하철 이용방법</li>
                    <li class="text8" style="color:#a6a6a6;">3호선 양재역 5번출구, 도보로 3분 소요 (약 200M)</li>
                    <li class="text12">차량 이용방법</li>
                    <li class="text8" style="color:#a6a6a6;">남부순환로 대로변 위치 (양재역 -> 도곡역 방향)</li>
                </ul>
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