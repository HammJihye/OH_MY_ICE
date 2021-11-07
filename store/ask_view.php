<?php
include("../dbconn.php");
include("../function.php");

$q_id=trim($_GET['q_id']);
$sql = "SELECT * FROM qna where q_id = '".$q_id."'";
$result = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($result);
//echo "<script>alert('$n_id');</script>";

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
                <li><a href="./register.php">JOIN</a></li>
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
                                <a href="../store/customer_center.php"><li>고객센터</li></a>
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
            <div class="ask_view_wrap">
                <div class="ask_title_wrap">
                    <ul>
                        <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                        <li><h1>QNA</h1></li>
                        <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                    </ul>
                </div>
                <div class="ask_content">
                    <hr>
                    <table class="ask_info_table">
                        <tr>
                            <td class="ask_col1">작성자</td>
                            <td class="ask_col2"><?php echo $row['mb_id'];?></td>
                        </tr>
                        <tr>
                            <td class="ask_col1">제목</td>
                            <td class="ask_col2"><?php echo $row['q_title'];?></td>
                        </tr>
                        <tr>
                            <td class="ask_col1">날짜</td>
                            <td class="ask_col2"><?php echo $row['q_date'];?></td>
                        </tr>
                        <tr>
                            <td class="ask_col3">내용</td>
                            <td class="ask_col4"><?php echo nl2br($row['q_content']);?></td>
                        </tr>
                    </table>
                </div>
                <div class="answer_content">
                    <img class="answer_mark" src="../assets/icons/outline_subdirectory_arrow_right_black_24dpx2.png" alt="">
                    <table class="ask_info_table">
                        <tr>
                            <td class="ask_col3">답변</td>
                            <?php if(strlen($row['ad_content'])>1){?>
                            <td class="ask_col4"><?php echo nl2br($row['ad_content']);?></td>
                            <?php } else {?>
                                <td class="ask_col4">아직 답변이 없습니다.</td>
                            <?php }?>
                        </tr>
                    </table>
                </div>
                <div class="btns_wrap" style="border:none;">
                    <button class="return_btn" onclick= "location.href ='./ask.php'">목록</button>
                    <?php if(isset($_SESSION['ss_mb_id'])){
                            if($mb_id == $row['mb_id']){    
                    ?>
                    <button class="update_btn" onclick= "location.href ='../write.php?cate=ask_update&q_id=<?php echo $row['q_id'];?>'">수정하기</button>
                    <?php   }
                            else if($mb_id == "admin"){
                                if(strlen($row['ad_content'])>1){//답변이 있을 때
                    ?>
                    <button class="update_btn" onclick= "location.href ='../write.php?cate=answer_update&q_id=<?php echo $row['q_id'];?>'">수정하기</button>
                    <?php       } else { //답변이 없을 때?>
                      <button class="update_btn" onclick= "location.href ='../write.php?cate=answer_insert&q_id=<?php echo $row['q_id'];?>'">답변하기</button>  
                    <?php }}}?>
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