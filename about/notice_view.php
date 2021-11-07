<?php
include("../dbconn.php");

$n_id=trim($_GET['n_id']);
$sql = "SELECT * FROM notice where n_id = '".$n_id."'";
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
                <li><a href="./login.php">LOGIN</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./register.php">JOIN</a></li>
                <?php } else {?>
                <li><a href="./logout.php">LOG OUT</a></li><!--로그아웃 & 마이페이지 -->
                <li><a href="./mypage.php">MY PAGE</a></li>
                <?php } ?>
                <form action="../result.php">
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
                    <li>EVENT
                        <ul>
                            <li>진행중인 이벤트</li>
                            <li>당첨자 발표</li>
                        </ul>
                    </li>
                    <li>STORE
                            <ul>
                                <a href="../store/customer_center.php"><li>고객센터</li></a>
                            </ul>
                    </li>				
                    <li>ABOUT
                        <ul>
                            <li>NOTICE</li>
                            <li>CONTACT US</li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="notice_view_wrap">
                <div class="notice_title_wrap">
                    <ul>
                        <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                        <li><h1>NOTICE</h1></li>
                        <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                    </ul>
                </div>
                <div class="notice_wrap">
                    <div class="title_text_wrap">
                        <p class="title_text2"><?php echo $row['title'];?></p>
                    </div>
                    <p class="text9"><?php echo $row['n_date'];?></p>
                    <div class="notice_content">
                        <?php if($row['n_img_path']!=null){ ?>
                            <img class="notice_img" src=".<?php echo $row['n_img_path'].$row['n_id'];?>.jpg" alt="">
                        <?php }?>
                        <div class="notice_content_text">
                            <?php echo $row['content'];?>
                        </div>
                    </div>
                    <div class="return_btn_wrap">
                    <button class="return_btn" onclick= "location.href ='./notice.php'">목록</button>
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