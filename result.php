<?php
include("./dbconn.php");
include("./function.php");

if(isset($_GET['search_word'])){
    $search_word = trim($_GET['search_word']);

    //몇 건
    $sql1_1 = "SELECT count(*) FROM product where p_name like '%".$search_word."%'";
    $resultCount1 = mysqli_query($conn,$sql1_1);
    if($rowCount1 = mysqli_fetch_array($resultCount1)){
        $p_row_count = $rowCount1["count(*)"];
    }

    //검색결과
    $sql1 = "SELECT * FROM product where p_name like '%".$search_word."%' limit 0, 5";
    $result1 = mysqli_query($conn,$sql1);

    $sql2_1 = "SELECT count(*) FROM qna where q_title like '%".$search_word."%'";
    $resultCount2 = mysqli_query($conn,$sql2_1);
    if($rowCount2 = mysqli_fetch_array($resultCount2)){
        $q_row_count = $rowCount2["count(*)"];
    }

    $sql2 = "SELECT * FROM qna where q_title like '%".$search_word."%' order by q_id desc limit 0, 5";
    $result2 = mysqli_query($conn,$sql2);

    $sql3_1 = "SELECT count(*) FROM notice where title like '%".$search_word."%'";
    $resultCount3 = mysqli_query($conn,$sql3_1);
    if($rowCount3 = mysqli_fetch_array($resultCount3)){
        $n_row_count = $rowCount3["count(*)"];
    }

    $sql3 = "SELECT * FROM notice where title like '%".$search_word."%' order by n_id desc limit 0, 5";
    $result3 = mysqli_query($conn,$sql3);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/basic.css">
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
                <a href=""><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
            <ul class="logo_nav">
                <li><a href="inedex.html">HOME</a></li>
                <li><a href="product.html">PRODUCT</a></li>
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="./login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./register.php">JOIN</a></li>
                <?php } else {?>
                <li><a href="./logout.php">LOG OUT</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./mypage.php">MY PAGE</a></li>
                <?php } ?>
                <form action="./result.php">
                <div class="search">
                    <div class="search-box">
                        <input type="text" id="search_word" class="search-txt" name="search_word" placeholder="Type to search">
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
                                <li>고객센터</li>
                            </ul>
                    </li>				
                    <li>ABOUT
                        <ul>
                            <li>NOTICE</li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="result_wrap">
               <p class="title_text3" style="color:#FFC4EB;">RESULT</p>
               <div class="search_result">
                    <div class="cate_result" style="border:none;">
                        <p class="text10">상품 : <?php echo $p_row_count; ?> 건의 검색결과</p>
                        <?php if($p_row_count == 0) {?>
                            <div class="no_result">
                                <p class="text3">상품에서 <span class="text11">"<?php echo $search_word;?>"</span>에 대한 검색 결과가 없습니다.</p>
                            </div>
                        <?php } else {
                                    //while($p_row  = mysqli_fetch_array($result1)){
                        ?>
                            <ul class="product_search_list">
                                <?php while($p_row  = mysqli_fetch_array($result1)){?>
                                <li>
                                    <a href="./product_detail.php?product=<?php echo $p_row['p_id'];?>">
                                        <table class="product_list_table">
                                            <tr>
                                                <td class="p_list_col1">
                                                    <img class="search_product_img" src="<?php echo $p_row['img_path'].$p_row['p_id'];?>.jpg" alt="">
                                                </td>
                                                <td class="p_list_col2"><?php echo $p_row['p_name'];?></td>
                                            </tr>
                                        </table>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                        <?php }?>
                        <?php if($p_row_count > 5){?>
                            <p class="text9"><a href="">더 보기 ></a></p>
                        <?php }?>
                    </div>
                    <div class="cate_result">
                        <p class="text10">문의사항 : <?php echo $q_row_count; ?> 건의 검색결과</p>
                        <?php if($q_row_count == 0) {?>
                            <div class="no_result">
                                <p class="text3">문의사항에서 <span class="text11">"<?php echo $search_word;?>"</span>에 대한 검색 결과가 없습니다.</p>
                            </div>
                        <?php } else {?>
                        <ul class="other_search_list">
                            <?php while($q_row  = mysqli_fetch_array($result2)){ ?>
                            <li><a href="./store/ask_view.php?q_id=<?php echo $q_row['q_id'];?>">[문의사항]<span class="other_search_result_text"><?php echo $q_row['q_title'];?></span></a></li>
                            <?php }?>
                        </ul>
                        <?php }?>
                        <?php if($q_row_count > 5){?>
                            <p class="text9"><a href="">더 보기 ></a></p>
                        <?php }?>
                    </div>
                    <div class="cate_result">
                        <p class="text10">공지사항  : <?php echo $n_row_count; ?> 건의 검색결과</p>
                        <?php if($n_row_count == 0) {?>
                            <div class="no_result">
                                <p class="text3">공지사항에서 <span class="text11">"<?php echo $search_word;?>"</span>에 대한 검색 결과가 없습니다.</p>
                            </div>
                        <?php } else {?>
                        <ul class="other_search_list">
                            <?php while($n_row  = mysqli_fetch_array($result3)){?>
                            <li><a href="./about/notice_view.php?n_id=<?php echo $n_row['n_id'];?>">[공지사항]<span class="other_search_result_text"><?php echo $n_row['title'];?></span></a></li>
                            <?php }?>
                        </ul>
                        <?php }?>
                        <?php if($n_row_count > 5){?>
                            <p class="text9"><a href="">더 보기 <i class="fas fa-arrow-right"></i></a></p>
                        <?php }?>
                    </div>
               </div>
            </div>
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