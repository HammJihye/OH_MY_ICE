<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/dropdown.js"></script>
    <title>Document</title>
  </head>
  <body>
    <div class="wrap">
        <div class="header">
            <div class="top">
                <div class="logo_image">
                    <a href="./index.php"><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
                </div>
                <ul class="logo_nav">
                    <li><a href="./index.php">HOME</a></li>
                    <li><a href="./product.php?menu=ice">PRODUCT</a></li>
                    <!-- 로그인했으면 다르게-->
                    <li><a href="login.html">LOGIN</a></li>
                    <li><a href="./register.php">JOIN</a></li>
                    <li>
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
                                    <li>매장찾기</li>
                                    <li>고객센터</li>
                                </ul>
                        </li>				
                        <li>ABOUT
                            <ul>
                                <li><a href="./notice.php">공지사항</a></li>
                                <li>CONTACT US</li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="main">
            <div class="mainContent">
                <h2 class="titleText1">로그인</h2>
                <div class="section">
                    <i class="fas fa-lock fa-3x" style="color : #6c5ce7;"></i>
                    <p class="text1">다양한 서비스를 이용하시려면 로그인이 필요합니다.</br>
                        회원이 아닌 분은 먼저 회원가입을 해주시기 바랍니다.</p>
                </div>
                <form action="./login_check.php" method="post" class="loginForm">
                    <input type="hidden" name="login" value="user">
                    <div class="idForm">
                    <input type="text" class="id" placeholder="ID" name ="mb_id">
                    </div>
                    <div class="passForm">
                    <input type="password" class="pw" placeholder="PW" name = "mb_pwd">
                    </div>
                    <input type="submit" class="btn" value="로그인">
                </form>
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