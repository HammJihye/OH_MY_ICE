<?php
include("../dbconn.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basic.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/dropdown.js"></script>
    <title>Document</title>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="top">
            <div class="logo_image">
                <a href=""><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
            <ul class="logo_nav">
                <li><a href="inedex.html">HOME</a></li>
                <li><a href="product.html">PRODUCT</a></li>
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="../login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="../register.php">JOIN</a></li>
                <?php } else {?>
                <li><a href="../logout.php">LOG OUT</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="../mypage/mypage.php">MY PAGE</a></li>
                <?php } ?>
                <form action="../result.php">
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
                                <a href="./customer_center.php"><li>고객센터</li></a>
                                <a href="./faq.php"><li>FAQ</li></a>
                                <a href="./ask.php"><li>문의하기</li></a>
                            </ul>
                    </li>				
                    <li>ABOUT
                        <ul>
                            <a href="../about/notice.php"><li>NOTICE</li></a>
                            <a href="../about/contact_us.php"><li>CONTACT US</li></a>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="title_text_area">
                <ul>
                    <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                    <li><p class="text4">고객센터</p></li>
                    <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                </ul>
            </div>
            <div class="clk_list_area">
                <ul class="clk_list">
                    <li><a href="./customer_center.php" style="background-color:#FFD9EC;">고객센터 절차</a></li>
                    <li><a href="./faq.php">자주하는 질문</a></li>
                    <li><a href="./ask.php">문의하기</a></li>
                </ul>
            </div>
            <div class="claim_procedure">
                <p class="text5">고객 불만처리 프로세스</p>
                <ul class="procedure_graph">
                    <li>
                        <p class="graph_text">고객소리 접수</p>
                        <i class="fas fa-arrow-right" style="position:relative; float:right; top:25px; color: #a6a6a6;"></i>
                    </li>
                    <li>
                        <p class="graph_text">고객 상담</p>
                        <i class="fas fa-arrow-right" style="position:relative; float:right; top:25px; color: #a6a6a6;"></i>
                    </li>
                    <li>
                        <p class="graph_text">현업부서 전달</p>
                        <i class="fas fa-arrow-right" style="position:relative; float:right; top:25px; color: #a6a6a6;"></i>
                    </li>
                    <li>
                        <p class="graph_text">원인규명</p>
                        <i class="fas fa-arrow-right" style="position:relative; float:right; top:25px; color: #a6a6a6;"></i>
                    </li>
                    <li>
                        <p class="graph_text">개선대책</p>
                        <i class="fas fa-arrow-right" style="position:relative; float:right; top:25px; color: #a6a6a6;"></i>
                    </li>
                    <li>
                        <p class="graph_text">개선 및 반영</p>
                    </li>
                </ul>
                <p class="text5">고객 불만접수 채널</p>
                <ul class="guide_text">
                    <li>1. 전화 및 인터넷, 점포 등 다양한 채널을 통해 접수</li>
                    <li>2. 통합시스템에 일괄 접수, 관할 부서 / 담당자에게 통보</li>
                    <li>3. 공정거래 위원회 고시 소비자분쟁 해결 기준에 의거하여 처리</li>
                </ul>
                <div class="icons_area">
                    <ul class="icons">
                        <li>
                            <span class="fa-stack fa-2x" style="float:left;">
                                <i class="far fa-circle fa-stack-2x"></i>
                                <i class="fas fa-phone-alt fa-stack-1x" style="color:#FFB2D9;"></i>
                            </span>
                            <ul class="icons_text">
                                <li class="text6">전화</li>
                                <li class="text7">080-555-1313</li>
                                <li class="text6">09:00~18:00</li>
                                <li class="text6">(주말 공휴일 제외 / 수신자 부담)</li>
                            </ul>
                        </li>
                        <li>
                            <i class="fas fa-desktop fa-3x" style="float:left; margin-right:10px; "></i>
                            <ul class="icons_text">
                                <li class="text6">인터넷</li>
                                <li class="text8">http://www.oh_my_ice.co.kr/</li>
                                <li class="text6">상담접수 시간 24시간</li>
                                <li><button class="btn2">바로가기</button></li>
                            </ul>
                        </li>
                        <li>
                            <i class="fas fa-store fa-3x" style="float:left; margin-right:10px; "></i>
                            <ul class="icons_text">
                                <li class="text6">점포</li>
                                <li class="text8" style="font-weight:bold;">구매점포 연락처 확인</li>
                                <li><button class="btn2">바로가기</button></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="claim_standard">
                    <p class="text5">소비자 분쟁 해결 기준</p>
                    <ul class="guide_text">
                    <li>1. 전화 및 인터넷, 점포 등 다양한 채널을 통해 접수</li>
                    <li>2. 통합시스템에 일괄 접수, 관할 부서 / 담당자에게 통보</li>
                    <li>3. 공정거래 위원회 고시 소비자분쟁 해결 기준에 의거하여 처리</li>
                    </ul>
                    <table class="standard_table">
                        <tr class="row1"><th>구분</th><th>피해유형</th><th>보상기준</th></tr>
                        <tr class="row2"><td rowspan="2" class="col1">식품</td>
                            <td class="col2">함량, 용량부족, 부패변질,유통기한경과, 이물혼입</td>
                            <td class="col2">제품교환 또는 구입가 환불</td>
                        </tr>
                        <tr class="row2">
                            <td class="col2">부작용, 상해사고</td>
                            <td>
                                <ul>
                                    <li>치료비, 경비 및 일실소득배상</li>
                                    <li>(단, 피해로 인하여 소득상실이 발생한 사실이 입증될 시 한함.</li>
                                    <li>금액을 입증할 수 없는 경우에는 시중 노임단가를 기준으로 함)</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
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