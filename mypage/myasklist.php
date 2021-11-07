<?php

include("../dbconn.php");
include("../function.php");

$sql = "SELECT count(*) FROM qna where mb_id = '".$mb_id."'";
$resultCount = mysqli_query($conn,$sql);
if($rowCount = mysqli_fetch_array($resultCount)){
    $total_record = $rowCount["count(*)"];   //php는 지역 변수를 밖에서 사용 가능.
}
$list = 5;
$block_cnt =5;
$block_num= ceil($page / $block_cnt);
$block_start = (($block_num-1) * $block_cnt) +1;
$block_end = $block_start + $block_cnt -1;

$total_page = ceil($total_record / $list);
$page_start = ($page - 1) * $list;

$sql2 = "SELECT * FROM qna where mb_id = '".$mb_id."' order by q_id asc limit ".$page_start.",".$list."";
$result = mysqli_query($conn,$sql2);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mypage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/dropdown.js"></script>
	<script src="../js/checkbox.js"></script>
    <title>Document</title>
</head>

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
                <li><a href="./login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./register.php">JOIN</a></li>
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
                            <li><a href="../about/notice.php">공지사항</a></li>
                            <li><a href="../about/contact_us.php">CONTACT US</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
		<div class="mainContent">
			<h1 class="titleText1">문의내역</h1>
			<form action="../delete.php" method="post">
			<input type="hidden" name="cate" value="ask">
            <input type="hidden" name="delete_ask" value="y">
			<div class="ask_view_table_wrap">
				<table class="ask_view_table">
					<tr class="ask_table_row1">
						<th>선택</th><th>제목</th><th>작성 날짜</th><th>답변여부</th><th>수정하기</th>
					</tr>
					<?php while($row = mysqli_fetch_array($result)) {	?>
					<tr class="ask_table_row2">
						<td class="ask_table_col1">
						<input type="checkbox" class="ask_chk_box" name="chk[]" value=<?php echo $row['q_id'];?>>
						</td>
						<td class="ask_table_col2" style="width:350px;" id="q_title">
						<a href="../store/ask_view.php?q_id=<?php echo $row['q_id'];?>">
						<?php echo $row['q_title'];?>
						</a>
						</td>
						<td class="ask_table_col2"><?php echo $row['q_date'];?></td>
						<td class="ask_table_col2">
							<?php if(strlen($row['ad_content'])>1){?>
								답변 완료
                            <?php } else {?>
                                답변 없음
                            <?php }?>
						</td>
						<td><input type="button" class="btn4" onclick= "location.href ='../write.php?cate=ask_update&q_id=<?php echo $row['q_id']; ?>'" value="수정하기"></td>
					</tr>
					<?php 
					} ?>
				</table>
			</div>
			<div class = "btn_box">
				<input type="hidden" name="buy_option" value="basket_selected">
				<input type='checkbox' name='chk[]' value="selectAll" onclick='selectAll(this)'/>  전체 선택
				<input type="submit" class="btn3" value="선택 삭제">
            </div>
			</form>
			<form action="../delete.php" method="post">
                <div class="return_submit_btn_wrap">
					<input type="hidden" name="delete_ask_all" value="y">
                    <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
                    <input type="button" class="btn5" value="문의사항으로" onclick= "location.href ='../store/ask.php'">
                    <input type="submit" class="btn6" value="전체 삭제하기">
                </div>
            </form>
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
</body>
</html>