<?php
include("../dbconn.php");

if(isset($_GET["page"])){
    $page = $_GET["page"];
}
else {
    $page = 1;
}

if(isset($_GET['searchword'])){
    $find = trim($_GET['find']);
    $searchword = trim($_GET['searchword']);
    switch ($find) {
        case 'all' :  $sql = "SELECT * FROM notice where title like '%".$searchword."%' or content like '%".$searchword."%'";break;
        case 'title' :  $sql = "SELECT * FROM notice where title like '%".$searchword."%'";break;
        case 'content' : $sql = "SELECT * FROM notice where content like '%".$searchword."%'";break;
    }
}
else{
    $sql = "SELECT * FROM notice";
}
    $result_Count = mysqli_query($conn,$sql);
    $total_record = mysqli_num_rows($result_Count);//전체 칼럼
    $list = 5;
    $block_cnt =5;
    $block_num= ceil($page / $block_cnt);
    $block_start = (($block_num-1) * $block_cnt) +1;
    $block_end = $block_start + $block_cnt -1;

    $total_page = ceil($total_record / $list);
    $page_start = ($page - 1) * $list;
    if(isset($_GET['searchword'])){
        switch ($find) {
            case 'all' :  $sql2 = "SELECT * FROM notice where title like '%".$searchword."%' or content like '%".$searchword."%' order by n_id desc limit ".$page_start.",".$list."";$result = mysqli_query($conn,$sql2);break;
            case 'title' :  $sql2 = "SELECT * FROM notice where title like '%".$searchword."%' order by n_id desc limit ".$page_start.",".$list."";$result = mysqli_query($conn,$sql2);break;
            case 'content' : $sql2 = "SELECT * FROM notice where content like '%".$searchword."%' order by n_id desc limit ".$page_start.",".$list."";$result = mysqli_query($conn,$sql2);break;
        }
    }
    else {
        $sql2 = "SELECT * FROM notice order by n_id desc limit ".$page_start.",".$list."";
        $result = mysqli_query($conn,$sql2);
    }
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/notice.css">
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
                                <a href="../store/faq.php"><li>FAQ</li></a>
                                <a href="../store/ask.php"><li>문의하기</li></a>
                            </ul>
                    </li>					
                    <li>ABOUT
                        <ul>
                            <li><a href="./notice.php">공지사항</a></li>
                            <li><a href="./contact_us.php">CONTACT US</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="section1">
            <ul>
                <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
                <li><h1>NOTICE</h1></li>
                <li><i class="fas fa-genderless fa-2x" style="position:relative;top:20px; color:pink"></i></li>
            </ul>
        </div>
        <div class="text_box">
            <p class="text1">배스킨라빈스의 신제품 안내, 신규 CF등 다양한 소식을 알려드립니다!</p>
            <p class="text2">총<span class="num"><?php echo $total_record;?></span>건</p>
        </div>
        <table>
            <?php
            while($row = mysqli_fetch_array($result)) {
            ?>
            <tr><td><?php echo $row['n_id'];?></td><td><a href="./notice_view.php?n_id=<?php echo $row['n_id'];?>"><?php echo $row['title'];?></a></td><td><?php echo date("Y-m-d",strtotime($row['n_date']));?></td></tr>
            <?php } ?>
        </table>
        <?php if(isset($_SESSION['ss_mb_id'])){
                if($_SESSION['ss_mb_id']=="admin"){?>
                <div class="write_btn">
                    <form action="../write.php" method="post">
                        <input type="hidden" name="mode" value="admin_write">
                        <input type="submit" class="btn1" value="글쓰기">
                    </form>
                </div>
        <?php }}?>
        <div class="section2">
                <?php
                
                    if ($page > 1){
                            echo "<a href='./notice.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                            $pre = $page -1;
                            echo "<a href='./notice.php?page=".$pre."'><i class='fas fa-angle-left'></i></a>";
                    }
                    else {
                        echo "<a href='./notice.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                        echo "<a href='./notice.php?page=1'><i class='fas fa-angle-left'></i></a>";
                    }
                    
                    if($total_page < $block_cnt){
                        $block_end = $total_page;
                    }
                    
                    for($i = $block_start; $i <= $block_end; $i++){
                        if($page == $i){
                            echo "<b><span style='font-size : 2em'>$i</span> </b>";
                        }
                        else {
                            echo "<a href='./notice.php?page=".$i."'><span style='font-size : 2em'>".$i."</span></a>";
                        }
                    }

                    if($page < $total_page){
                        $next = $page +1;
                            echo "<a href='./notice.php?page=".$next."'><i class='fas fa-angle-right'></i></a>";
                            echo "<a href='./notice.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                    }
                    else {
                        echo "<a href='./notice.php?page=".$total_page."'><i class='fas fa-angle-right'></i></a>";
                        echo "<a href='./notice.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                    }
                    mysqli_close($conn);
                    ?>
        </div>
        <div class="section3">
            <form action="./notice.php">
                <select class="slc" name="find">
                    <option value="all">전체</option>
                    <option value="title">제목</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" class="txt_box" name="searchword">
                <input type="submit" class="btn1" value="검색">
            </form>
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