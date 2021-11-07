<?php

include("../dbconn.php");
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
else {
    $page = 1;
}
if(isset($_SESSION['ss_mb_id'])){
    $mb_id = trim($_SESSION['ss_mb_id']);
    $sql = "SELECT * FROM member where mb_id='$mb_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
}
$sql2 = "SELECT count(*) FROM orders where mb_id = '".$mb_id."'";
$resultCount = mysqli_query($conn,$sql2);
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
$sql3="SELECT * from orders where mb_id = '".$mb_id."' order by o_id desc limit ".$page_start.",".$list."";
$result3 = mysqli_query($conn, $sql3);
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
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/dropdown.js"></script>
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
                            <li><a href="../notice.php">공지사항</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
            <div class="mainContent">
                <h1 class="titleText1">주문목록/배송조회</h1>
                <?php if($total_record == 0){ ?>
                <div class="alarm">
                    <p>주문한 내역이 없습니다.</p>
                </div>
                <?php } ?>
                <div class="section">
                <?php while($o_row = mysqli_fetch_array($result3)) {?>
                    <div class="order_list">
                        <div class="text_box">
                            <h2><?php echo $o_row['o_date'];?></h2>
                            <h3><a href="./order_detail_view.php?o_id=<?php echo $o_row['o_id'];?>" style="color:blue;">주문 상세 보기 ></a></h3>
                        </div>
                        <div class="order_detail_box">
                            <div class="product_box">
                                <div class="text1"><?php echo $o_row['o_state'];?></div>
                                <ul class="product_detail">
                                    <?php 
                                    $sql4="SELECT *,count(o_id) from order_detail  join product on order_detail.p_id= product.p_id where o_id = '".$o_row['o_id']."' group by o_id ";
                                    $result4 = mysqli_query($conn, $sql4);
                                    $detail_row =  mysqli_fetch_array($result4);

                                    $s_sql="SELECT sum(o_price) as sum_o_price from order_detail where o_id = '".$o_row['o_id']."'"; 
                                    $s_result= mysqli_query($conn, $s_sql);
                                    $s_row =  mysqli_fetch_array($s_result);
                                    ?>
                                    <li><img class="img_box" src="<?php echo ".".$detail_row['img_path'].$detail_row['p_id']?>.jpg" alt=""></li>
                                    <li>
                                        <ul class="textlist">
                                            <li><?php echo $detail_row['p_name'].",";?>
                                            <span class="space-left"><?php echo $detail_row['o_amount']."개";?></span>
                                            <?php if($detail_row['count(o_id)']>1){?>
                                                <span class="space-left">외 <?php echo $detail_row['count(o_id)']-1;?>건</span>
                                            <?php }?>
                                        </li>
                                            <li><?php echo $s_row['sum_o_price']."원";?></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="click_list_box">
                                <ul class="click_list">
                                    <li><a href="">배송 조회</a></li>
                                    <li><a href="./order_detail_view.php?o_id=<?php echo $o_row['o_id'];?>">교환, 반품 신청</a></li>
                                    <li><a href="">리뷰 작성</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php }?>
                    <div class="btn_area" style="margin: auto;width: 800px;text-align: center;">
                    <?php
                
                if ($page > 1){
                        echo "<a href='./mypage.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                        $pre = $page -1;
                        echo "<a href='./mypage.php?page=".$pre."'><i class='fas fa-angle-left'></i></a>";
                }
                else {
                    echo "<a href='./mypage.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                    echo "<a href='./mypage.php?page=1'><i class='fas fa-angle-left'></i></a>";
                }
                
                if($total_page < $block_cnt){
                    $block_end = $total_page;
                }
                
                for($i = $block_start; $i <= $block_end; $i++){
                    if($page == $i){
                        echo "<b><span style='font-size : 2em'>$i</span> </b>";
                    }
                    else {
                        echo "<a href='./mypage.php?page=".$i."'><span style='font-size : 2em'>".$i."</span></a>";
                    }
                }

                if($page < $total_page){
                    $next = $page +1;
                        echo "<a href='./mypage.php?page=".$next."'><i class='fas fa-angle-right'></i></a>";
                        echo "<a href='./mypage.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
                else {
                    echo "<a href='./mypage.php?page=".$total_page."'><i class='fas fa-angle-right'></i></a>";
                    echo "<a href='./mypage.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
                mysqli_close($conn);
                ?>
                    </div>
                    <div class="order_notice">
                        <p>배송상품 주문상태 안내</p>
                        <div class="icons">
                            <ul>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="far fa-credit-card fa-stack-1x"></i>
                                    </span>
                                    <p>결제 완료</p>
                                </li>
                                <li><i class="fas fa-chevron-right fa-3x" style="color:#a6a6a6;"></i></li>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="far fas fa-box-open fa-stack-1x"></i>
                                    </span>
                                    <p>상품 준비중</p>
                                </li>
                                <li><i class="fas fa-chevron-right fa-3x" style="color:#a6a6a6;"></i></li>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="fas fa-box fa-stack-1x"></i>
                                    </span>
                                    <p>배송 시작</p>
                                </li>
                                <li><i class="fas fa-chevron-right fa-3x" style="color:#a6a6a6;"></i></li>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="fas fa-truck-moving fa-stack-1x"></i>
                                    </span>
                                    <p>배송 중</p>
                                </li>
                                <li><i class="fas fa-chevron-right fa-3x" style="color:#a6a6a6;"></i></li>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="fas fa-home fa-stack-1x"></i>
                                    </span>
                                    <p>배송 완료</p>
                                </li>
                            </ul>
                        </div>
                        <ul class="text_box2">
                            <p>
                            <span class="fa-stack fa-1x">
                                    <i class="far fa-circle fa-stack-2x" style="color:red;"></i>
                                    <i class="fas fa-exclamation fa-stack-1x" style="color:red;"></i>
                            </span>
                            <span class="text3">취소/반품/교환 신청</span>전에 확인해주세요!
                            </p>
                            <li>
                                <p class="text2">취소</p>
                                <ul>
                                    <li>- 여행/레저/숙박 상품은 취소 시 수수료가 발생할 수 있으며,</li>
                                    <li>취소수수료를 확인하여 2일 이내(주말,공휴일 제외) 처리결과를 문자로 안내해드립니다.(당일 접수 기준, 마감시간 오후 4시)</li>
                                    <li>- 문화 상품은 사용 전날 24시까지 취소 신청 시 취소수수료가 발생되지않습니다.</li>
                                </ul>
                            </li>
                            <li>
                                <p class="text2">반품</p>
                                <ul>
                                    <li>- 상품 수령 후 7일 이내 신청하여 주세요.</li>
                                    <li>- 상품이 출고된 이후에는 배송 완료 후, 반품 상품을 회수합니다.</li>
                                    <li>- 설치상품/주문제작/해외배송/신선냉동 상품 등은 고객센터에서만 반품 신청이 가능합니다.</li>
                                </ul>
                            </li>
                            <li>
                                <p class="text2">교환</p>
                                <ul>
                                    <li>상품의 교환 신청은 고객센터로 문의하여 주세요.</li>
                                </ul>
                            </li>
                        </ul>
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
            <div>LOGO</div>
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
