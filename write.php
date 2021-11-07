<?php
include("./dbconn.php");
include("./function.php");
if(isset($_POST['search_whether'])){
    $mode="update";
    $q_id=trim($_POST['slc_qid']);
    $case=5;//답변 입력
    $title_text="답변하기";
    $sql = "SELECT * FROM qna where q_id = '$q_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $q_date= $row['q_date'];
}
if(isset($_GET['q_id'])){
    $mode="update";
    $q_id=trim($_GET['q_id']);
    $sql = "SELECT * FROM qna where q_id = '$q_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $q_date= $row['q_date'];
}
else {
    //문의사항 입력
    $q_date = date("Y-m-d");
}
if(isset($_GET['cate'])){
    switch($_GET['cate']){
        case 'ask_insert' : $case=1;$title_text="문의하기";$mode="insert";break;//문의 입력
        case 'ask_update' : $case=2;$title_text="수정하기";break;//문의 수정
        case 'answer_insert_all' : $case=3;$mode="search";$title_text="문의선택";
            $sql1 = "SELECT * FROM qna where ad_whether = '0'";
            $result1 = mysqli_query($conn, $sql1);
            break;
        case 'answer_update' : //답변 수정
            $case=4;$title_text="수정하기";break;
        case 'answer_insert' : //답변 입력
            $case=5;$title_text="답변하기";break;
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/basic.css?after">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
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
                <li><a href="product.php?menu=ice">PRODUCT</a></li>
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="./login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./register.php">JOIN</a></li>
                <?php } else {?>
                <li><a href="./logout.php">LOG OUT</a></li><!--로그아웃 & 마이페이지 -->
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
        <div class="section">
            <div class="ask_view_wrap">
                <div class="ask_title_wrap">
                    <ul>
                        <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                        <li><h1><?php echo $title_text;?></h1></li>
                        <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                    </ul>
                </div>
                <?php if($mode == "update"){?>
                    <!--답변 입력, 수정 문의사항 수정 -->
                    <form action="./update.php" method="post">
                    <input type="hidden" name="q_id" value="<?php echo $q_id;?>">
                    <input type="hidden" name="mb_id" value="<?php echo $row['mb_id'];?>">
                        <?php if($case==2){?>
                            <input type="hidden" name="qna_update" value="ask">
                        <?php }else{?>
                            <input type="hidden" name="qna_update" value="answer">
                        <?php }?>
                <?php } else if($mode == "insert"){ ?>
                    <form action="./insert.php" method="post">
                    <input type="hidden" name="ask_insert" value="y">
                    <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
                <?php } else {?>
                    <form action="./write.php" method="post">
                    <input type="hidden" name="search_whether" value="yes">
                <?php }?>
                <div class="ask_content">
                    <hr>
                    <table class="ask_info_table">
                        <tr>
                            <td class="ask_col1">작성자</td>
                            <td class="ask_col2">
                                <?php switch($case){
                                        case 1 :
                                        case 2 : 
                                            echo $mb_id;break;
                                        case 4 :
                                        case 5 : 
                                            echo $row['mb_id'];break;?>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="ask_col1">제목</td>
                            <td class="ask_col2">
                                <?php switch($case){
                                        //문의사항 입력일 때
                                        case 1 : ?>
                                            <input type="text" name="q_title" class="q_title"><?php break;
                                        case 2 :?>
                                            <input type="text" class="q_title" name="q_title" value="<?php echo $row['q_title'];?>"><?php break;
                                        case 3 : ?>
                                            <select name="slc_qid" id="">
                                                <?php while($q_row = mysqli_fetch_array($result1)) {?>
                                                <option value="<?php echo $q_row['q_id'];?>"><?php echo $q_row['q_title'];?></option>
                                                <?php }?>
                                            </select>
                                            <input type="submit" value="검색하기">
                                            <?php break;
                                        case 4:
                                        case 5:
                                            echo $row['q_title'];?> 
                                            <?php break;
                                    }?>
                            </td>
                        </tr>
                        <tr>
                            <td class="ask_col1">날짜</td>
                            <td class="ask_col2">
                                <?php echo $q_date; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="ask_col3">내용</td>
                            <td class="ask_col4">
                                <?php switch($case){
                                        //문의사항 입력일 때
                                        case 1 : ?>
                                            <textarea name="q_content" class="q_content" id=""></textarea><?php break;
                                        case 2 :?>
                                            <textarea name="q_content" class="q_content" id=""><?php echo $row['q_content'];?></textarea><?php break;
                                        case 4:
                                        case 5:
                                            echo nl2br($row['q_content']);?> 
                                            <?php break;
                                    }?>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php if($mb_id =="admin"){?>
                    <input type="hidden" name="admin_id" value="<?php echo $mb_id;?>">
                    <input type="hidden" name="anwser_where" value="user">
                <div class="answer_content">
                    <img class="answer_mark" src="./assets/icons/outline_subdirectory_arrow_right_black_24dpx2.png" alt="">
                    <table class="ask_info_table">
                        <tr>
                            <td class="ask_col3">답변</td>
                            <td class="ask_col4">
                                <?php if($case == 4){?>
                                <textarea name="ad_content" class="ad_content"><?php echo $row['ad_content']?></textarea>
                                <?php }else { ?>
                                <textarea name="ad_content" class="ad_content" id=""></textarea>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php }?>
                <div class="btns_wrap" style="border:none;">
                    <button type="button" class="return_btn" onclick= "location.href ='./store/ask.php'" style="margin-right:15px;">취소하기</button>
                    <?php if($case==1){?>
                    <input type="submit" class="update_btn" value="등록하기">
                    <?php }else {?>
                    <input type="submit" class="update_btn" value="수정하기">
                    <?php } ?>
                </div>
                </form>
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