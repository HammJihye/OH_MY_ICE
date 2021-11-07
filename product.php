<?php

include("./dbconn.php");
include("./function.php");
if(isset($_SESSION['ss_mb_id'])){
    $user_id = trim($_SESSION['ss_mb_id']); 
}
$sql = "SELECT count(*) FROM product where category like '%".$category."%'";
$resultCount = mysqli_query($conn,$sql);
if($rowCount = mysqli_fetch_array($resultCount)){
    $total_record = $rowCount["count(*)"];   //php는 지역 변수를 밖에서 사용 가능.
}
$list = 12;
$block_cnt =5;
$block_num= ceil($page / $block_cnt);
$block_start = (($block_num-1) * $block_cnt) +1;
$block_end = $block_start + $block_cnt -1;

$total_page = ceil($total_record / $list);
$page_start = ($page - 1) * $list;

$sql2 = "SELECT * FROM product where category like '%".$category."%' order by p_id asc limit ".$page_start.",".$list."";
$result = mysqli_query($conn,$sql2);


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/product.css">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/dropdown.js"></script>
    <title>PRODUCT</title>
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
                <?php if(!isset($_SESSION['ss_mb_id'])) { ?>
                <li><a href="./login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./register.php">JOIN</a></li>
                <?php } else {?>
                <li><a href="./logout.php">LOG OUT</a></li><!--로그아웃 & 마이페이지 -->
                            <?php if(strpos($user_id, "admin") !== false) {?>
                                    <li><a href="./admin/index.php">ADMIN</a></li>
                                <?php }else {?>
                                    <li><a href="./mypage/mypage.php">MY PAGE</a></li>
                                <?php } ?>
                <?php } ?>
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
    <div class="img_box">
        <img src="img/<?php echo $category;?>.jpg" alt="">
    </div>
    <div class="main">
        <h1 class="text1">
            <?php
            if($_GET['menu'] == 'ice'){
                echo "Ice Cream";
            }else{
                echo ucfirst($category);
            }
            ?>
        </h1>
        <ul class="product_list">
        <?php
                while($row = mysqli_fetch_array($result)) {
                ?>
                <li>
                    <dl>
                        <dt><a href="./product_detail.php?product=<?php echo $row['p_id'];?>"><?php echo $row['p_name']; ?></a></dt>
                        <dd class="img">
                            <a href="./product_detail.php?product=<?php echo $row['p_id'];?>">
                            <?php echo "<img src='".$row['img_path'].$row['p_id'].".jpg' />"; ?>
                            </a>
                        </dd>
                    </dl>
                </li>
                <?php }?>
        </ul>
    </div>
    <div class="page_btn">
    <?php
        if ($page > 1){
                echo "<a href='./product.php?menu=".$category."&page=1'><i class='fas fa-angle-double-left'></i></a>";
                $pre = $page -1;
                echo "<a href='./product.php?menu=".$category."&page=".$pre."'><i class='fas fa-angle-left'></i></a>";
        }
        else {
            echo "<a href='./product.php?menu=".$category."&page=1'><i class='fas fa-angle-double-left'></i></a>";
            echo "<a href='./product.php?menu=".$category."&page=1'><i class='fas fa-angle-left'></i></a>";
        }
        
        if($total_page < $block_cnt){
            $block_end = $total_page;
        }
        
        for($i = $block_start; $i <= $block_end; $i++){
            if($page == $i){
                echo "<b><span style='font-size : 2em'>$i</span> </b>";
            }
            else {
                echo "<a href='./product.php?menu=".$category."&page=".$i."'><span style='font-size : 2em'>".$i."</span></a>";
            }
        }

        if($page < $total_page){
            $next = $page +1;
                echo "<a href='./product.php?menu=".$category."&page=".$next."'><i class='fas fa-angle-right'></i></a>";
                echo "<a href='./product.php?menu=".$category."&page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
        }
        else {
            echo "<a href='./product.php?menu=".$category."&page=".$total_page."'><i class='fas fa-angle-right'></i></a>";
            echo "<a href='./product.php?menu=".$category."&page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
        }
        mysqli_close($conn);
        ?>
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
<script>

</script>
</html>