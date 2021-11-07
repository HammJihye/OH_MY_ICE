<?php

include("../dbconn.php");
include("../function.php");

$sql = "SELECT count(*) from request where mb_id = '".$mb_id."'";
$resultCount = mysqli_query($conn,$sql);
if($request_row = mysqli_fetch_array($resultCount)){
    $total_record = $request_row["count(*)"];   //php는 지역 변수를 밖에서 사용 가능.
}
$list = 5;
$block_cnt =5;
$block_num= ceil($page / $block_cnt);
$block_start = (($block_num-1) * $block_cnt) +1;
$block_end = $block_start + $block_cnt -1;

$total_page = ceil($total_record / $list);
$page_start = ($page - 1) * $list;

$sql2 = "SELECT * , count(r.o_id) as order_count from request as r join order_detail as od on r.o_id= od.o_id join product on od.p_id=product.p_id where mb_id = '".$mb_id."' group by r_id order by r_id asc limit ".$page_start.",".$list."";
$result = mysqli_query($conn,$sql2);

$i=1;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basket_list.css">
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
                <li><a href="../index.php">HOME</a></li>
                <li><a href="../product.php?menu=ice">PRODUCT</a></li>
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="../login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="../register.php">JOIN</a></li>
                <?php } else {?>
                <li><a href="../logout.php">LOG OUT</a></li><!--로그아웃 & 마이페이지 -->
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
                <h1 class="titleText1">취소/교환/반품/환불 목록</h1>
                <div class="section">
                <form action="../update.php" name="f" method="post">
                    <table>
                        <tr><th>상품</th><th>이름</th><th>수량</th><th>상태</th></tr>
                    <?php while($row = mysqli_fetch_array($result)) {
                            ?>
                        <tr>
                            <td><input type="checkbox" class="chk_box" id=<?php echo "c".$i;?> name="chk[]" value=<?php echo $row['o_id'];?>><img class="img_box" src="<?php echo ".".$row['img_path'].$row['p_id']?>.jpg" alt=""></td>
                            <?php if($row['order_count']>1) {?>
                            <td><a href="./order_detail_view.php?o_id=<?php echo $row['o_id'];?>"><?php echo $row['p_name'];?>
                            <span style="margin:0 5px 0 5px;">외</span><?php echo $row['order_count']-1;?>건</a></td>
                            <?php } else {?>
                            <td><a href="./order_detail_view.php?o_id=<?php echo $row['o_id'];?>"><?php echo $row['p_name'];?></a></td>
                            <?php }?>
                            <td><?php echo $row['o_amount'];?></td>
                            <td><?php echo $row['r_state'];?></td>
                        </tr>
                        <?php 
                        $i++;
                    }?>
                    </table>
                    <div class = "btn_box">
                        <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
                        <input type="hidden" name="request_selected_cancle" value="y">
                        <input type='checkbox' name='chk[]' value="selectAll" onclick='selectAll(this)'/>  전체 선택
                        <input type="submit" class="btn1" value="요청 취소">
                    </div>
                </form>
                </div>
                <div class="section2">
                <?php
                
                    if ($page > 1){
                            echo "<a href='./request_view.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                            $pre = $page -1;
                            echo "<a href='./request_view.php?page=".$pre."'><i class='fas fa-angle-left'></i></a>";
                    }
                    else {
                        echo "<a href='./request_view.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                        echo "<a href='./request_view.php?page=1'><i class='fas fa-angle-left'></i></a>";
                    }
                    
                    if($total_page < $block_cnt){
                        $block_end = $total_page;
                    }
                    
                    for($i = $block_start; $i <= $block_end; $i++){
                        if($page == $i){
                            echo "<b><span style='font-size : 2em'>$i</span> </b>";
                        }
                        else {
                            echo "<a href='./request_view.php?page=".$i."'><span style='font-size : 2em'>".$i."</span></a>";
                        }
                    }

                    if($page < $total_page){
                        $next = $page +1;
                            echo "<a href='./request_view.php?page=".$next."'><i class='fas fa-angle-right'></i></a>";
                            echo "<a href='./request_view.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                    }
                    else {
                        echo "<a href='./request_view.php?page=".$total_page."'><i class='fas fa-angle-right'></i></a>";
                        echo "<a href='./request_view.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                    }
                    mysqli_close($conn);
                    ?>
                </div>
                <form action="../update.php" method="post">
                <input type="hidden">
                <div class="section3">
                    <input type="hidden" name="request_all_cancle" value="y">
                    <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
                    <input type="submit" class="btn3" value="전체 취소하기">
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
                            <li><a href="">취소/반품/교환/환불내역</a></li>
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