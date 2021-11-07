<?php

include("../../dbconn.php");
include("../../function.php");

$sql1 = "SELECT * FROM member where mb_id='$mb_id'";
$result1 = mysqli_query($conn, $sql1);
$mb_row = mysqli_fetch_array($result1);

$o_state="결제완료";
$sql2 = "SELECT o_state, recipient, final_address, recipient_phone, ship_request, p.p_id, img_path, o.o_id
        from orders as o join recipient as r on o.o_id=r.o_id join order_detail as od on o.o_id=od.o_id join product as p on od.p_id=p.p_id
        where mb_id = '".$mb_id."' and o_state = '".$o_state."' group by o.o_id";
$resultCount = mysqli_query($conn,$sql2);
$total_record =  mysqli_num_rows($resultCount);

$list = 5;
$block_cnt =5;
$block_num= ceil($page / $block_cnt);
$block_start = (($block_num-1) * $block_cnt) +1;
$block_end = $block_start + $block_cnt -1;

$total_page = ceil($total_record / $list);
$page_start = ($page - 1) * $list;

$sql3 = "SELECT o_state, o_date, recipient, final_address, recipient_phone, ship_request, p.p_id as p_number, img_path, o.o_id as o_number
        from orders as o join recipient as r on o.o_id=r.o_id join order_detail as od on o.o_id=od.o_id join product as p on od.p_id=p.p_id 
        where mb_id = '".$mb_id."' and o_state = '".$o_state."' group by o.o_id order by r_no asc limit ".$page_start.",".$list."";
$result3 = mysqli_query($conn,$sql3);

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
                <li><a href="../../product.php?menu=ice">HOME</a></li>
                <li><a href="product.html">PRODUCT</a></li>
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
			<h1 class="titleText1">배송지 관리하기</h1>
            <div class="myaddress_table_wrap">
                <p class="text2" style="margin:0 0 10px 55px;"><i class="far fa-check-square" style="margin-right:10px; color:#4374D9;"></i>내 주소 변경하기</p>
                <form action="../../update.php" method="post" onsubmit="return addressform_submit(this);">
                <input type="hidden" name="myadd_update" value="y">
                <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
                <table class="myaddress_table">
                    <tr>
                        <th class="myadd_col1">현 주소</th>
                        <th class="myadd_col1">변경할 주소</th>
                        <th class="myadd_col1">변경하기</th>
                    </tr>
                    <tr>
                        <td class="myadd_col2"><?php echo $mb_row['mb_address'];?></td>
                        <td class="myadd_col2">
                            <input type="text" class="input_box3" id="sample6_postcode" name= "mb_postcode" placeholder="우편번호">
                            <input type="button" class="btn7" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                            <input type="text" class="input_box3" id="sample6_address" name = "mb_address" placeholder="주소"><br>
                            <input type="text" class="input_box3" id="sample6_detailAddress" name = "mb_detailAddress" placeholder="상세주소">
                            <input type="text" class="input_box3" id="sample6_extraAddress" placeholder="참고항목">
                        </td>
                        <td class="myadd_col2"><input type="submit" class="btn7" value="변경하기"></td>
                    </tr>
                </table>
                <p class="text8" style="margin-top:10px;">*주소 변경후에 변경 전에 주문한 주문 배송지는 변경되지 않습니다.</p>
                <p class="text8" style="font-size:0.9em;">그러니 주문의 주소지 변경이 필요하다면 따로 주소지 변경을 해야합니다.*</p>
                </form>
            </div>
            <div class="recipient_list_wrap">
                <p class="text2"  style="margin:0 0 10px 55px;"><i class="far fa-check-square" style="margin-right:10px; color:#4374D9;"></i>주소지 변경 가능한 결제 목록</p>
                <ul class="recipient_list">
                <?php while($r_row = mysqli_fetch_array($result3)) {?>
                    <li>
                        <a href="../order_detail_view.php?o_id=<?php echo $r_row['o_number'];?>&recipient=update"><p class="text7">주문 상세/주소 변경</p></a>
                        <div class="recipinet_content">
                            <img class="r_product_img" src="<?php echo "../.".$r_row['img_path'].$r_row['p_number'];?>.jpg" alt="">
                            <table class="recipient_table">
                                <tr>
                                    <td class="r_col1">주문번호</td>
                                    <td class="r_col2"><?php echo $r_row['o_number'];?></td>
                                </tr>
                                <tr>
                                    <td class="r_col1">주문날짜</td>
                                    <td class="r_col2"><?php echo $r_row['o_date'];?></td>
                                </tr>
                                <tr>
                                    <td class="r_col1">주소지</td>
                                    <td class="r_col2"><?php echo $r_row['final_address'];?></td>
                                </tr>
                            </table> 
                        </div>
                    </li>
                <?php }?>
                </ul>
            </div>
            <div class="btn_area" style="margin: auto;width: 800px;text-align: center;">
                    <?php
                
                if ($page > 1){
                        echo "<a href='./myaddress.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                        $pre = $page -1;
                        echo "<a href='./myaddress.php?page=".$pre."'><i class='fas fa-angle-left'></i></a>";
                }
                else {
                    echo "<a href='./myaddress.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                    echo "<a href='./myaddress.php?page=1'><i class='fas fa-angle-left'></i></a>";
                }
                
                if($total_page < $block_cnt){
                    $block_end = $total_page;
                }
                
                for($i = $block_start; $i <= $block_end; $i++){
                    if($page == $i){
                        echo "<b><span style='font-size : 2em'>$i</span> </b>";
                    }
                    else {
                        echo "<a href='./myaddress.php?page=".$i."'><span style='font-size : 2em'>".$i."</span></a>";
                    }
                }

                if($page < $total_page){
                    $next = $page +1;
                        echo "<a href='./myaddress.php?page=".$next."'><i class='fas fa-angle-right'></i></a>";
                        echo "<a href='./myaddress.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
                else {
                    echo "<a href='./myaddress.php?page=".$total_page."'><i class='fas fa-angle-right'></i></a>";
                    echo "<a href='./myaddress.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
                mysqli_close($conn);
                ?>
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
<script>
    function addressform_submit(f){
        if(f.mb_postcode.value.length < 1){
        alert("변경할 주소를 입력해주세요.");
        return false;
    }
    return true;
    }
</script>
</body>
</html>