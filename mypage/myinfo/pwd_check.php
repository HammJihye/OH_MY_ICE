<?php
include("../../dbconn.php");
include("../../function.php");
$cate = $_GET['myinfo_cate'];
?>
<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/login.css?after">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../../js/dropdown.js"></script>
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
                    <li><a href="../../product.php?menu=ice">PRODUCT</a></li>
                    <!-- 로그인했으면 다르게-->
                    <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                    <li><a href="../../login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                    <li><a href="../../register.php">JOIN</a></li>
                    <?php } else { ?>
                            <li><a href="../../logout.php">LOG OUT</a></li>
                            <li><a href="../mypage.php">MY PAGE</a></li>
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
                                    <li>매장찾기</li>
                                    <li>고객센터</li>
                                </ul>
                        </li>				
                        <li>ABOUT
                            <ul>
                                <li><a href="../../about/notice.php">공지사항</a></li>
                                <li>CONTACT US</li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="main">
            <div class="mainContent">
                <h2 class="titleText1">비밀번호 확인</h2>
                <div class="section">
                    <i class="fas fa-lock fa-3x" style="color : #6c5ce7;"></i>
                    <?php if($_GET['myinfo_cate']=="myinfo"){?>
                        <p class="text1">회원정보를 변경하기 위해서는 먼저 비밀번호 확인이 필요합니다.</p>
                    <?php } else if($_GET['myinfo_cate']=="myaddress") {?>
                        <p class="text1">배송지 관리를 하기위해서는 먼저 비밀번호 확인이 필요합니다.</p>
                    <?php } else{ ?>
                        <p class="text1">회원탈퇴를 하기위해서는 먼저 비밀번호 확인이 필요합니다.</p>
                    <?php }?>
                </div>
                <form action="../../login_check.php" method="post" class="loginForm">
                    <?php 
                        switch($cate){
                            case "myinfo" : ?>
                                <input type="hidden" name="myinfo_cate" value="myinfo">
                            <?php   break;
                            case "myaddress" : ?>
                                <input type="hidden" name="myinfo_cate" value="myaddress">
                            <?php break;
                            case "delete_account" : ?>
                                <input type="hidden" name="myinfo_cate" value="delete_account">
                                <?php break;
                        }
                    ?>
                    <input type="hidden" name="pwd_chk" value="y">
                    <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
                    <div class="passForm">
                    <input type="password" class="pw" placeholder="PW" name = "mb_pwd_chk">
                    </div>
                    <input type="submit" class="btn" value="로그인">
                </form>
            </div>
            <div class="sidebar">
                <div class="sidebar_logo_wrap">
                    <a href="./"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
                </div>
                <ul>
                    <li class="sidebar_list">
                        <p>MY 쇼핑</p>
                        <ul>
                            <li><a href="../mypage.php">주문목록/배송조회</a></li>
                            <li><a href="../basket_list.php">장바구니 목록조회</a></li>
                            <li><a href="../request_view.php">취소/반품/교환/환불내역</a></li>
                        </ul>
                    </li>
                    <li class="sidebar_list">
                        <p>MY 활동</p>
                        <ul>
                            <li><a href="../myasklist.php">문의내역</a></li>
                            <li><a href="">찜 리스트</a></li>
                        </ul>
                    </li>
                    <li class="sidebar_list">
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