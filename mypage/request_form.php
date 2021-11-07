<?php
include("../dbconn.php");
$request=trim($_GET['request']);
switch($request){
    case "cancle" : $state="취소";break;
    case "refund" : $state="환불";break;
    case "return" : $state="반품";break;
    case "exchange" : $state="교환";break;
}
$o_id=trim($_GET['o_id']);
$sql = "SELECT * from order_detail as od join product as p on od.p_id=p.p_id where o_id = '".$o_id."'";
$result = mysqli_query($conn,$sql);
$sql2 = "SELECT * , sum(o_price) as total_price, sum(o_amount) as total_amount from orders as o join order_detail as od on o.o_id=od.o_id where o.o_id = '".$o_id."'";
$result2 = mysqli_query($conn,$sql2);
$o_row= mysqli_fetch_array($result2);
$total_price=$o_row['total_price'];
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
    <script src="../js/form_chk.js"></script>
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
                <li><a href="../login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="../register.php">JOIN</a></li>
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
                                <a href="../store/customer_center.php"><li>고객센터</li></a>
                                <a href="../store/faq.php"><li>FAQ</li></a>
                                <a href="../store/ask.php"><li>문의하기</li></a>
                            </ul>
                    </li>				
                    <li>ABOUT
                        <ul>
                            <li><a href="../notice.php">공지사항</a></li>
                            <li>QNA</li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
            <div class="mainContent">
                <h1 class="titleText1">제품 <?php echo $state;?> 하기</h1>
                <div class="section">
                    <div class="refund_notice">
                        <p style="color:#FF0000; font-size:1.2em; text-align:center;">※공지사항을 먼저 읽고 신청해주세요※</p>
                        <p>반품 및 교환 안내</p>
                        <div class="refund_icons">
                            <ul>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="fas fa-pen fa-stack-1x"></i>
                                    </span>
                                    <p>요청사항 접수</p>
                                </li>
                                <li><i class="fas fa-chevron-right fa-3x" style="color:#a6a6a6;"></i></li>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="far fa-check-square fa-stack-1x"></i>
                                    </span>
                                    <p>고객센터에서</p>
                                    <p>반품픽업 접수</p>
                                </li>
                                <li><i class="fas fa-chevron-right fa-3x" style="color:#a6a6a6;"></i></li>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="fas fa-truck-moving fa-stack-1x"></i>
                                    </span>
                                    <p>택배기사님께</p>
                                    <p>반품할 제품</p>
                                    <p>전달</p>
                                </li>
                                <li><i class="fas fa-chevron-right fa-3x" style="color:#a6a6a6;"></i></li>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="fas fa-money-bill-alt fa-stack-1x"></i>
                                    </span>
                                    <p>반품 배송비</p>
                                    <p>입금</p>
                                </li>
                                <li><i class="fas fa-chevron-right fa-3x" style="color:#a6a6a6;"></i></li>
                                <li>
                                    <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x" style="color:#eaeaea;"></i>
                                    <i class="fas fa-box-open fa-stack-1x"></i>
                                    </span>
                                    <p>제품 확인후</p>
                                    <p>환불 및 요청</p>
                                    <p>처리 진행</p>
                                </li>
                            </ul>
                        </div>
                        <div class="table_area">
                            <table class="notice_table">
                                <tr class="table_title_text"><td colspan="2">고객센터 안내</td></tr>
                                <tr>
                                    <td class="notice_col1">고객센터</td>
                                    <td class="notice_col2">
                                        <ul>
                                            <li>상담문의 : 080-555-3131</li>
                                            <li>운영시간 : 9:00 ~ 18:00</li>
                                            <li>점심시간 : 13:00 ~ 14:00</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="table_title_text"><td colspan="2">배송 안내</td></tr>
                                <tr>
                                    <td class="notice_col1">접수안내</td>
                                    <td class="notice_col2">
                                        <ul>
                                            <li>-취소/교환/반품 문의는 상품 수령후 7일이내 고객센터로 문의 주시거나 절차에 따른 신청서 작성을 부탁드립니다.</li>
                                            <li>-고객변심/상품불량/오배송의 경우 7일 이내 문의 주셔야 교환 및 반품이 가능합니다.</li>
                                            <li>-제품이 불량인 경우 동일한 제품으로만 교환 가능하며 배송비는 '배스킨라빈스'에서 부담합니다.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="notice_col1">반품안내</td>
                                    <td class="notice_col2">
                                        <ul>
                                            <li>-제품 불량을 제외한 반품시 왕복 배송료를 부담하셔야 합니다.</li>
                                            <li>-반품의 경우 받으신 상품 그대로 보내 주셔야 하며 고객님 책임이 있는 상품 파손 및 변형의 경우 반품이 불가 합니다.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="notice_col1">교환/반품 주의사항</td>
                                    <td class="notice_col2">
                                        <ul>
                                            <li>-반품/교환 기일이 지난 상품은 접수가 불가합니다.</li>
                                            <li>-고객님의 책임이 있는 상품 변형 및 파손의 경우 교환/반품이 불가합니다.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="notice_col1">택배안내</td>
                                    <td class="notice_col2">
                                        <ul>
                                            <li>-우체국택배/편의점택배/한진택배/cj 택배</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <form action="../update.php" method="post" onsubmit="return frequest_insert_submit(this);">
                    <input type="hidden" name="request" value="<?php echo $request;?>">
                    <input type="hidden" name="o_id" value="<?php echo $o_id;?>">
                    <div class="request_form">
                    <p class="titleText2">주문상세 내역
                        <span class="text6" style="margin:0 10px 0 10px;">(주문번호 :</span>
                        <span class="text6"><?php echo "0000".$o_id; ?></span>
                        <span class="text6">)</span>
                    </p>
                        <table class="product_list">
                            <tr class="list_row1"><th>상품</th><th>이름</th><th>수량</th><th>가격</th></tr>
                            <?php while($row = mysqli_fetch_array($result)) {
                                $cate = $row['category'];    
                            ?>
                            <tr>
                                <td><img class="order_detail_img_box" src="<?php echo ".".$row['img_path'].$row['p_id']?>.jpg" alt=""></td>
                                <?php if($cate == "ice" || $cate == "beverage") {?>
                                <td><?php echo $row['p_name'];?></td>
                                <td><?php echo $row['o_amount'];?>개</td>
                                <td><?php echo $row['o_price'];?>원</td>
                                <?php } else {
                                    $total_price = $row['p_price'];
                                    $od_id=$row['o_detail_id'];
                                    $sql5="SELECT * from order_detail as od join product as p on od.flavor=p.p_id where o_detail_id = '".$od_id."'";
                                    $result5 = mysqli_query($conn,$sql5);
                                    $od_row_= mysqli_fetch_array($result5);
                                ?>
                                <td><?php echo $row['p_name']."(".$od_row_['p_name'].")";?></td>
                                <td>1개</td>
                                <td></td>
                                <?php }?>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="2">합계</td>
                                <?php if($cate == "ice" || $cate == "beverage") {?>
                                <td><?php echo $o_row['total_amount'];?>개</td>
                                <td><?php echo $total_price; ?>원</td>
                                <?php } else {
                                ?>
                                <td>1개</td>
                                <td><?php echo $total_price; ?>원</td>
                                <?php }?>
                            </tr>
                        </table>
                        <p class="titleText2">주문상품 <?php echo $state;?>하기</p>
                        <table class="write_area">
                            <tr>
                                <td class="write_col1"><?php echo $state;?> 사유</td>
                                <td class="write_col2">
                                    <select name="reason" id="">
                                        <option value="slc1" selected>선택</option>
                                        <option value="reorder">재주문 하기 위해</option>
                                        <option value="wrongorder">주문이 잘못되어서</option>
                                        <option value="changeofheart">마음이 바뀌어서</option>
                                        <option value="poorpackaging">포장이 불량이어서</option>
                                        <option value="deliverydelay">배송이 지연되어서</option>
                                        <option value="defectiveproduct">상품이 불량이어서</option>
                                        <option value="etc">기타등등</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="write_col3">상세 사유</td>
                                <td class="write_col4">
                                    <textarea name="detail_reason" class="detail_reason" id="" cols="30" rows="10"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="write_col1">환불계좌정보</td>
                                <td class="write_col2">
                                    <select name="bank" id="" style="width:100px;">
                                        <option value="NK">농협은행</option>
                                        <option value="Hana">하나은행</option>
                                        <option value="ShinHan">신한은행</option>
                                    </select>
                                    <span>계좌번호 : <input type="text" name="account_num"></span>
                                    <span>예금주 : <input type="text" name="account_name"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="submit_btn_area">
                        <input type="button" class="btn2" value="이전페이지로"  onclick="location.href='./mypage.php'" style="margin-right:20px;">
                        <input type="submit" class="btn2" value="확인">
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