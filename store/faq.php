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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <li><a href="product.html">PRODUCT</a></li>
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
                                <a href="./customer_center.php"><li>고객센터</li></a>
                                <a href="./faq.php"><li>FAQ</li></a>
                                <a href="./ask.php"><li>문의하기</li></a>
                            </ul>
                    </li>				
                    <li>ABOUT
                        <ul>
                            <a href="../about/notice.php"><li>NOTICE</li></a>
                            <a href="../about/contact_us.php"><li>CONTACT US</li></a>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="title_text_area">
                <ul>
                    <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                    <li><p class="text4">고객센터</p></li>
                    <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                </ul>
            </div>
            <div class="clk_list_area">
                <ul class="clk_list">
                    <li><a href="./customer_center.php">고객센터 절차</a></li>
                    <li><a href="./faq.php"  style="background-color:#FFD9EC;">자주하는 질문</a></li>
                    <li><a href="./ask.php">문의하기</a></li>
                </ul>
            </div>
        </div>
        <div class="question_area">
            <p class="title_text1">자주하는 질문</p>
            <div id="Accordion_wrap">
                <div class="question">
                <span>아이스크림도 배달이 되나요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>구매하시면 녹지 않게 포장되어 배송됩니다. </li>
                        <li>배달가능 지역(점포), 배달가능 제품의 제한이 있으므로 확인 후 구매 부탁드립니다</li>
                    </ul>
                </span>
                </div>
                <div class="question">
                <span>아이스크림 케이크의 보관은 어떻게 하나요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>구매 시 포장된 드라이아이스를 제거하고, 냉동고에 보관하시면 됩니다. </li>
                    </ul>
                </span>
                </div>
                <div class="question">
                <span>아이스크림 케이크에 꽂은 생일초를 제거할 때 은박지가 케이크 속에 남아있네요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>아이스크림은 냉동제품으로 생일초를 꽂은 후 초를 제거할 때 케이크 속에 은박지가 남아있을 수 있으니</li>
                        <li>생일초의 은박지까지 완전히 제거된 것을 확인 후 드실 것을 권해드립니다.</li>
                    </ul>
                </span>
                </div>
                <div class="question">
                <span>운영시간은 어떻게 되나요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>오전 9시부터 21시까지입니다.</li>
                        <li>(계절과 매장에 따라 약간의 차이가 있을 수 있습니다.)</li>
                    </ul>
                </span>
                </div>
                <div class="question">
                <span>현금연수증이 가능하나요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>현금으로 구매 시 현금영수증카드, 전화번호, 사업자 번호 등으로 발급 가능합니다.</li>
                    </ul>
                </span>
                </div>
                <div class="question">
                <span>홈페이지 탈퇴는 어떻게 하나요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>로그인 후 마이페이지에 가셔서 회원탈퇴에 가셔서 진행 가능하십니다.</li>
                    </ul>
                </span>
                </div>
                <div class="question">
                <span>회원정보 변경은 어떻게 하나요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>로그인 후 마이페이지에 가셔서 회원정보에서 진행 가능하십니다.</li>
                    </ul>
                </span>
                </div>
                <div class="question">
                <span>아이스크림의 유통기한은 어떻게 되나요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>아이스크림은 냉동 제품으로 유통기한이 없으나</li>
                        <li>배스킨라빈스는 신선한 제품 공급을 위해 자체적인 유통기한을 설정하여 관리하고 있습니다.</li>
                        <li>배스킨라빈스 제품의 유통기한은 제조일로부터 1년입니다.</li>
                    </ul>
                </span>
                </div>
                <div class="question">
                <span>탈퇴 후 재가입은 가능한가요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>신규가입과 동일하게 회원가입 절차를 통해 가능합니다.</li>
                    </ul>
                </span>
                </div>
                <div class="question">
                <span>회원가입을 하면 어떤 이점이 있나요?</span>
                </div>
                <div class="answer">
                <span class="a_mark">A</span>
                <span>
                    <ul class="answer_text">
                        <li>등록된 메일주소를 통해 이벤트 및 신제품에 대한 정보를 정기적으로 받아 보실 수 있습니다.</li>
                    </ul>
                </span>
                </div>
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
<script>
$(".question").click(function() {
   $(this).next(".answer").stop().slideToggle(300);
  $(this).toggleClass('on').siblings().removeClass('on');
  $(this).next(".answer").siblings(".answer").slideUp(300); // 1개씩 펼치기
});
</script>
</html>