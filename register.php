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
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="js/fregisterform.js"></script>
    <script src="js/address.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/dropdown.js"></script>
    <script src="js/id_check.js"></script>
    <script src="js/check_email.js"></script>
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
                    <li><a href="./login.php">LOGIN</a></li>
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
                            <li><i class="far fa-edit fa-3x"></i></br>
                                <ul class="iconText"><li>개인정보 작성</li></ul>
                            </li>
                            <li><i class="fas fa-angle-double-right fa-3x"></i></li>
                            <li><i class="far fa-envelope fa-3x" style="color: #bcbcbc;"></i></br>
                                <ul class="iconText"><li>이메일 인증</li></ul>
                            </li>
                            <li><i class="fas fa-angle-double-right fa-3x" style="color: #bcbcbc;"></i></li>
                            <li><i class="far fa-check-circle fa-3x" style="color: #bcbcbc;"></i></br>
                                <ul class="iconText"><li>가입 완료</li></ul>
                            </li>
                        </ul>
                    </div>
                    <form method="post" action="./register_update.php" onsubmit="return fregisterform_submit(this);">
                        <h3 class="titleText2">개인정보 작성</h3>
                        <div class="form_container">
                            <div class="insert">
                                <table>
                                    <tr>
                                        <td class="col1">이름</td>
                                        <td class="col2">
                                            <input type="text" name="mb_name" maxlength="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col1">아이디</td>
                                        <td class="col2"><input type="text" name="userid" id="userid"  class="check" maxlength="10">
                                        <div id="id_check" style="color:#a6a6a6;">아이디가 실시간으로 검사됩니다</div></td>
							</td>
                                    </tr>
                                    <tr>
                                        <td class="col1">비밀번호</td>
                                        <td class="col2">
                                            <input type="password" name="mb_pwd" maxlength="16">
                                            <p>※비밀번호는 <span class="num">문자, 숫자, 특수문자(~!@#$%^&*)의 조합
                                            10 ~ 16자리</span>로 입력이 가능합니다.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col1">비밀번호 확인</td>
                                        <td class="col2">
                                        <input type="password" name="repwd" maxlength="16"></td>
                                    </tr>
                                    <tr>
                                        <td class="col1">휴대 전화</td>
                                        <td class="col2"><input type="text" name="mb_phone" maxlength="12"></td>
                                    </tr>
                                    <tr>
                                        <td class="col1">이메일</td>
                                        <td class="col2">
                                            <input type="text" id = "email1" name="email1">
                                            <span class="a">@</span>
                                            <input type="text" id = "email2" name="email2">
                                            <select name="email3" id = "email3">
                                                <option value="" selected="selected">직접입력</option>
                                                <option value="naver.com">naver.com</option>
                                                <option value="gmail.com">gmail.com</option>
                                                <option value="daum.com">daum.com</option>
                                                <option value="yahoo.com">yahoo.com</option>
                                            </select>
                                            <input class='but2' type="button" value="이메일 중복확인" onclick="checkemail();">
                                            </br>
                                            <span class="num" style="font-size:0.7em;">※실제 메일이여야 합니다※</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col1">성별</td>
                                        <td class="col2"><select name="gender">
                                            <option value="slc1" selected>선택</option>
                                            <option value="man">남자</option>
                                            <option value="female">여자</option>
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col1">주소</td>
                                        <td class="col2">
                                            <input type="text" id="sample6_postcode" name= "mb_postcode" placeholder="우편번호">
                                            <input type="button" class="but2" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                                            <input type="text" id="sample6_address" name = "mb_address" placeholder="주소"><br>
                                            <input type="text" id="sample6_detailAddress" name = "mb_detailAddress" placeholder="상세주소">
                                            <input type="text" id="sample6_extraAddress" placeholder="참고항목">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                    
                            <div class="create">
                                <input class="but3" type="submit" value="가입취소" onclick="">
                                <input class="but3" type="submit" value="회원가입">
                            </div>
                        </div>
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
  <script>
        $( "#email3" ).change(function(){
            $("#email2").val( $("#email3").val() );
        });
        
    </script>
</html>