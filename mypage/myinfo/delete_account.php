<?php
include("../../dbconn.php");
include("../../function.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/mypage.css?after">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../../js/address.js"></script>
    <script src="../../js/dropdown.js"></script>
    <title>Document</title>
</head>

<body>
<div class="wrap">
    <div class="header">
        <div class="top">
            <div class="logo_image">
                <a href="../../index.php"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
            <ul class="logo_nav">
                <li><a href="../../index.php">HOME</a></li>
                <li><a href="../../product.php?menu=ice">PRODUCT</a></li>
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="../../login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="../../register.php">JOIN</a></li>
                <?php } else { ?>
                        <li><a href="../../logout.php">LOG OUT</a></li>
                        <li><a href="../mypage.php">MY PAGE</a></li>
               <?php } ?>
                <form action="../../result.php">
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
                            <a href="../../product.php?menu=ice"><li>ICE CREAM</li></a>
                            <a href="../../product.php?menu=beverage"><li>DRINK</li></a>
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
                            <a href="../../store/customer_center.php"><li>고객센터</li></a>
                            <a href="../../store/faq.php"><li>FAQ</li></a>
                            <a href="../../store/ask.php"><li>문의하기</li></a>
                            </ul>
                    </li>				
                    <li>ABOUT
                        <ul>
                            <a href="../../about/notice.php"><li>NOTICE</li></a>
                            <a href="../../about/contact_us.php"><li>CONTACT US</li></a>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
		<div class="mainContent">
			<h1 class="titleText1">회원 탈퇴하기</h1>
            <div class="delete_account_wrap">
                <div class="delete_confirm_text">
                    <i class="fas fa-exclamation-triangle fa-5x" style="color:red;"></i>
                    <p class="text9">정말 탈퇴하시겠습니까?</p>
                    <p class="text10">탈퇴한다면 구매내역, 환불내역등 정보들이 전부 삭제됩니다.</p>
                </div>
                <form action="../../delete.php" method="post">
                    <input type="hidden" name="leave_id" value="member">
                    <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
                    <input type="submit" class="btn6" value="탈퇴하기">
                </form>
            </div>
		</div>
		<div class="sidebar">
			<!-- 밑에 한칸 더 만들까 고민-->
            <div class="sidebar_logo_wrap">
                <a href="./"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
			<ul>
			<!-- 시간이 된다면 마우스가 닿았을 때 색이 변하게 & 선택된 것이 색이 다르게 -->
				<li class="sidebarlist">
					<p>MY 쇼핑</p>
					<ul>
						<li><a href="../mypage.php">주문목록/배송조회</a></li>
						<li><a href="../basket_list.php">장바구니 목록조회</a></li>
						<li><a href="../request_view.php">취소/반품/교환/환불내역</a></li>
					</ul>
				</li>
				<li class="sidebarlist">
					<p>MY 활동</p>
					<ul>
						<li><a href="../myasklist.php">문의내역</a></li>
						<li><a href="">찜 리스트</a></li>
					</ul>
				</li>
				<li class="sidebarlist">
					<p>MY 정보</p>
					<ul>
                        <li><a href="./pwd_check.php?myinfo_cate=myinfo">회원정보 변경</a></li>
                        <li><a href="./pwd_check.php?myinfo_cate=myaddress">나의 배송지 관리</a></li>
                        <li><a href="./pwd_check.php?myinfo_cate=delete_account">회원 탈퇴</a></li>
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
</body>
</html>