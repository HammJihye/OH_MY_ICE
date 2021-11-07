<?php

include("../../dbconn.php");
include("../../function.php");

$sql = "SELECT * FROM member where mb_id='$mb_id'";
$result = mysqli_query($conn, $sql);
$mb_row = mysqli_fetch_array($result);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/mypage.css">
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
                            <a href="../../store/customer_center.php"><li>고객센터</li></a>
                            <a href="../../store/faq.php"><li>FAQ</li></a>
                            <a href="../../store/ask.php"><li>문의하기</li></a>
                            </ul>
                    </li>				
                    <li>ABOUT
                        <ul>
                            <li><a href="../../about/notice.php">공지사항</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
		<div class="mainContent">
			<h1 class="titleText1">내 정보 변경하기</h1>
            <div class="myinfo_wrap">
            <form action="../../update.php" method="post" onsubmit="return fregisterform_submit(this);">
                <input type="hidden" name="myinfo_update" value="y">
                <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
                <table class="myinfo_table">
                    <tr>
                        <td class="myinfo_col1" style="border-top:1px solid #eaeaea;">아이디</td>
                        <td class="myinfo_col2" style="border-top:1px solid #eaeaea;">
                            <?php echo $mb_id;?>
                        </td>
                    </tr>
                    <tr>
                        <td class="myinfo_col1">비밀번호</td>
                        <td class="myinfo_col2">
                            <input type="text" class="input_box1" name="mb_pwd" value="<?php echo $mb_row['mb_pwd'];?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="myinfo_col1">이름</td>
                        <td class="myinfo_col2">
                            <input type="text" class="input_box1" name="mb_name" value="<?php echo $mb_row['mb_name'];?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="myinfo_col1">이메일</td>
                        <td class="myinfo_col2">
                            <input type="text" class="input_box2" name="mb_email" value="<?php echo $mb_row['mb_email'];?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="myinfo_col1">전화번호</td>
                        <td class="myinfo_col2">
                            <input type="text" class="input_box2" name="mb_phone" value="<?php echo $mb_row['mb_phone'];?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="myinfo_col1">성별</td>
                        <td class="myinfo_col2">
                            <select class="input_box1" name="mb_gender" id="">
                                <option value="slc1">선택</option>
                                <option value="female">여자</option>
                                <option value="male">남자</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="myinfo_col1">주소</td>
                        <td class="myinfo_col2"><?php echo $mb_row['mb_address'];?></td>
                        <input type="hidden" name="mb_address" value="<?php echo $mb_row['mb_address'];?>">
                    </tr>
                    <tr>
                        <td class="myinfo_col1">변경할 주소</td>
                        <td class="myinfo_col2">
                            <input type="text" class="input_box3" id="sample6_postcode" name= "mb_postcode" placeholder="우편번호">
                            <input type="button" class="btn7" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                            <input type="text" class="input_box3" id="sample6_address" name = "change_address" placeholder="주소"><br>
                            <input type="text" class="input_box3" id="sample6_detailAddress" name = "change_detailAddress" placeholder="상세주소">
                            <input type="text" class="input_box3" id="sample6_extraAddress" placeholder="참고항목">
                        </td>
                    </tr>
                </table>
                <div class="update_btn_wrap">
                    <input type="submit" class="btn6" value="변경하기">
                </div>
                </form>
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