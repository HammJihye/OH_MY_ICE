<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/dropdown.js"></script>
    <title>Document</title>
  </head>
<?php
function email_certify_chk() { 
    include("./dbconn.php");
    $uid=trim($_SESSION['ss_uid']);
    $sql = "SELECT * FROM member where mb_id = '$uid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $certify_chk=$row['mb_email_certify'];
    if($certify_chk == 1){
        //이메일 인증을 했을 시에
        mysqli_close($conn);
        echo "<script>location.replace('./register_complete.php');</script>";
    }
    else{
        echo "<script>alert('이메일 인증을 하지 않았습니다.');</script>";
    }
} 
if(array_key_exists('certify_check',$_POST))
    { 
        email_certify_chk(); 
    }
?>
  <body>
    <div class="wrap">
        <div class="header">
            <div class="top">
                <div class="logo_image">
                    <a href="./index.php"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
                </div>
                <ul class="logo_nav">
                    <li><a href="./inedex.php">HOME</a></li>
                    <li><a href="./product.php?menu=ice">PRODUCT</a></li>
                    <!-- 로그인했으면 다르게-->
                    <li><a href="./login.php">LOGIN</a></li>
                    <li><a href="./register.php">JOIN</a></li>
                    <li>
                    <form action="./result.php">
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
            <div class="mainContent">
                <h2 class="titleText1">회원가입</h2>
                <div class="section">
                    <div class="icons">
                        <!-- 폰트 바꿔야 함 & 아이콘 색-->
                        <ul>
                            <li><i class="far fa-edit fa-3x" style="color: #bcbcbc;"></i></br>
                                <ul class="iconText"><li>개인정보 작성</li></ul>
                            </li>
                            <li><i class="fas fa-angle-double-right fa-3x" style="color: #bcbcbc;"></i></li>
                            <li><i class="far fa-envelope fa-3x"></i></br>
                                <ul class="iconText"><li>이메일 인증</li></ul>
                            </li>
                            <li><i class="fas fa-angle-double-right fa-3x"></i></li>
                            <li><i class="far fa-check-circle fa-3x" style="color: #bcbcbc;"></i></br>
                                <ul class="iconText"><li>가입 완료</li></ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <h3 class="titleText2">이메일 인증</h3>
                <div class="container">
                    <div class="text_box">
                        <p class="text1">이메일이 전송되었습니다</br>
                        인증이 완료되었으면 아래 버튼을 누르세요.
                        </p>
                        <form method="post">
                            <input type="submit" class="but3" name="certify_check" value="인증 완료">
                        </form>
                    </div>
                </div>
            </div>
            <div class="sidebar">
                <!-- 밑에 한칸 더 만들까 고민-->
                <div class="sidebar_logo_wrap">
                    <a href="./"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
                </div>
                <ul>
                <!-- 시간이 된다면 마우스가 닿았을 때 색이 변하게 & 선택된 것이 색이 다르게 -->
                <li class="sidebarlist"><a href="./login.php">로그인</a></li>
                <li class="sidebarlist"><a href="./register.php">회원가입</a></li>
                <li class="sidebarlist"><a href="">아이디 찾기</a></li>
                <li class="sidebarlist"><a href="">비밀번호 찾기</a></li>
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
  </body>
</html>