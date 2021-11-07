<?php
include("../dbconn.php");
include("../function.php");
include("./admin_id_chk.php");

if(isset($_GET['find_word'])){
  $find_category = trim($_GET['find_category']);
  $find_word = trim($_GET['find_word']);
  switch ($find_category) {
      case 'o_id' :  $sql = "SELECT * from orders where o_id like '%".$find_word."%'";break;
      case 'mb_id' :  $sql = "SELECT * from orders where mb_id like '%".$find_word."%'";break;
      case 'o_state' :  $sql = "SELECT * from orders where o_state like '%".$find_word."%'";break;
      case 'payment' :  $sql = "SELECT * from orders where payment like '%".$find_word."%'";break;
      case 'o_date' :  $sql = "SELECT * from orders where o_date like '%".$find_word."%'";break;
  }
}
else{
  $sql = "SELECT * FROM orders";
}
$result_Count = mysqli_query($conn,$sql);
$total_record = mysqli_num_rows($result_Count);//전체 칼럼
$list = 10;
$block_cnt =5;
$block_num= ceil($page / $block_cnt);
$block_start = (($block_num-1) * $block_cnt) +1;
$block_end = $block_start + $block_cnt -1;

$total_page = ceil($total_record / $list);
$page_start = ($page - 1) * $list;
  if(isset($_GET['find_word'])){
      switch ($find_category) {
          case 'o_id' :  $sql2 = "SELECT * from orders where o_id like '%".$find_word."%' order by o_id desc limit ".$page_start.",".$list."";
          $result = mysqli_query($conn,$sql2);break;
          case 'mb_id' :  $sql2 = "SELECT * from orders where mb_id like '%".$find_word."%' order by o_id desc limit ".$page_start.",".$list."";
          $result = mysqli_query($conn,$sql2);break;
          case 'o_state' : $sql2 = "SELECT * from orders where o_state = '".$find_word."' order by o_id desc limit ".$page_start.",".$list."";
          $result = mysqli_query($conn,$sql2);break;
          case 'payment' : $sql2 = "SELECT * from orders where payment = '".$find_word."' order by o_id desc limit ".$page_start.",".$list."";
          $result = mysqli_query($conn,$sql2);break;
          case 'o_date' : $sql2 = "SELECT * from orders where o_date = '".$find_word."' order by o_id desc limit ".$page_start.",".$list."";
          $result = mysqli_query($conn,$sql2);break;
      }
  }
  else {
      $sql2 = "SELECT * FROM orders order by o_id desc limit ".$page_start.",".$list."";
      $result = mysqli_query($conn,$sql2);
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>ADMIN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&display=swap" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    

    <!-- Bootstrap core CSS -->
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../css/admin.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">
</head>
<body>
<main>
      <input type="hidden" id="abc" value="23000">
  <div class="flex-shrink-0 p-3" style="width: 220px; background-color:#eaeaea;">
    <a href="../index.php" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
      <i class="fas fa-ice-cream" style="margin-right:5px;"></i>
      <span class="fs-5 fw-semibold">OH MY ICE</span>
    </a>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
          ORDER
        </button>
        <div class="collapse show" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="./sales_rate.php" class="link-dark rounded">판매량</a></li>
            <li><a href="./order_view.php" class="link-dark rounded">전체 주문 보기</a></li>
            <li><a href="./order_request.php" class="link-dark rounded">취소/교환/환불/반품 보기</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          PRODUCT
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="./product_view.php" class="link-dark rounded">전체 상품 보기</a></li>
            <li><a href="./write.php?cate=product" class="link-dark rounded">상품 변경/추가</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          MEMBER
        </button>
        <div class="collapse" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="./member_view.php" class="link-dark rounded">전체 회원 보기</a></li>
            <li><a href="#" class="link-dark rounded">회원 관리</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          ADMINISTER
        </button>
        <div class="collapse" id="account-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="./notice_view.php" class="link-dark rounded">공지사항 관리</a></li>
            <li><a href="./write.php?cate=notice" class="link-dark rounded">공지사항 쓰기</a></li>
            <li><a href="./qna_view.php" class="link-dark rounded">문의사항 관리</a></li>
            <li><a href="#" class="link-dark rounded">이벤트 관리</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
  <div class="wrap">
    <div class="header">
      <p class="text1">주문 보기</p>
      <form action="">
      <div class="search_area">
          <input type="text" class="input_text" placeholder="Search">
          <input type="submit" class="submit_btn" value="&#xf002;">
      </div>
    </form>
    </div>
      <div class="main">
        <div class="content">
          <div class="table_title">
            <p class="text3">전체 주문 내역</p>
          </div>
          <div class="order_table">
            <table>
                <tr style="background-color:#eaeaea;">
                <th>주문번호</th><th>주문날짜</th><th>회원 ID</th><th>결제 방식</th>
                <th>결제 상태</th><th>주문 상세</th><th>상태</th><th>수정하기</th><th>삭제 하기</th>
                </tr>
                <?php while($row = mysqli_fetch_array($result)) {
                  switch ($row['payment']){
                    case 'kakaopay' : $payment="카카오페이";break;
                    case 'account_transfer' : $payment="계좌이체";break;
                    case 'credit_card' : $payment="신용/체크 카드";break;
                    case 'corporation_card' : $payment="법인카드";break;
                    case 'phone' : $payment="휴대폰";break;
                    case 'despositor' : $payment="무통장 입금";break;
                  }
                ?>
                <tr>
                  <td><?php echo $row['o_id'];?></td>
                  <td><?php echo $row['o_date'];?></td>
                  <td><?php echo $row['mb_id'];?></td>
                  <td><?php echo $payment;?></td>
                  <td><?php echo $row['o_state'];?></td>
                  <td><a href="./detail_view.php?cate=order&o_id=<?php echo $row['o_id'];?>">주문 상세</a></td>
                  <form action="../update.php" method="post" onsubmit="return fo_state_update_submit(this);">
                  <input type="hidden" name="o_state_update" value="admin">
                  <input type="hidden" name="o_id" value="<?php echo $row['o_id'];?>">
                  <td>
                    <select name="order_state_update" id="">
                      <option value="slc1" selected>선택</option>
                      <option value="payment_complete">결제완료</option>
                      <option value="product_ready">상품 준비중</option>
                      <option value="ship_start">배송 시작</option>
                      <option value="shipping">배송 중</option>
                      <option value="delivery_complete">배송 완료</option>
                    </select>
                  </td>
                  <td>
                    <?php if(strpos( $row['o_state'], "요청") !==false ) {?>
                      <input type="button" class="btn4" value="수정하기" onclick="alert('여기서는 수정할 수 없습니다.');">
                    <?php } else {?>
                      <input type="submit" class="btn4" value="수정하기">
                    <?php } ?>
                  </td>
                </form>
                  <td><span class="delete_box"><a href="../delete.php?cate=order&o_id=<?php echo $row['o_id'];?>" onclick="return confirm('삭제하시겠습니까?');" style="color:#fff;">삭제하기</a></span></td>
                </tr>
                <?php } ?>
            </table>
          </div>
          <div class="page_btn">
          <?php
              if(isset($_GET['find_word'])){
                //검색 o
                if ($page > 1){
                        echo "<a href='./order_view.php?find_category=".$find_category."&find_word=".$find_word."&page=1'><i class='fas fa-angle-double-left'></i></a>";
                        $pre = $page -1;
                        echo "<a href='./order_view.php?find_category=".$find_category."&find_word=".$find_word."&page=".$pre."'><i class='fas fa-angle-left'></i></a>";
                }
                else {
                    echo "<a href='./order_view.php?find_category=".$find_category."&find_word=".$find_word."&page=1'><i class='fas fa-angle-double-left'></i></a>";
                    echo "<a href='./order_view.php?find_category=".$find_category."&find_word=".$find_word."&page=1'><i class='fas fa-angle-left'></i></a>";
                }
                
                if($total_page < $block_cnt){
                    $block_end = $total_page;
                }
                
                for($i = $block_start; $i <= $block_end; $i++){
                    if($page == $i){
                        echo "<b><span style='font-size : 2em'>$i</span> </b>";
                    }
                    else {
                        echo "<a href='./order_view.php?find_category=".$find_category."&find_word=".$find_word."&page=".$i."'><span style='font-size : 2em'>".$i."</span></a>";
                    }
                }

                if($page < $total_page){
                    $next = $page +1;
                        echo "<a href='./order_view.php?find_category=".$find_category."&find_word=".$find_word."&page=".$next."'><i class='fas fa-angle-right'></i></a>";
                        echo "<a href='./order_view.php?find_category=".$find_category."&find_word=".$find_word."&page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
                else {
                    echo "<a href='./order_view.php?find_category=".$find_category."&find_word=".$find_word."&page=".$total_page."'><i class='fas fa-angle-right'></i></a>";
                    echo "<a href='./order_view.php?find_category=".$find_category."&find_word=".$find_word."&page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
              }
              else {
                //검색 x
                if ($page > 1){
                  echo "<a href='./order_view.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                  $pre = $page -1;
                  echo "<a href='./order_view.php?page=".$pre."'><i class='fas fa-angle-left'></i></a>";
                }
                else {
                    echo "<a href='./order_view.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                    echo "<a href='./order_view.php?page=1'><i class='fas fa-angle-left'></i></a>";
                }
                
                if($total_page < $block_cnt){
                    $block_end = $total_page;
                }
                
                for($i = $block_start; $i <= $block_end; $i++){
                    if($page == $i){
                        echo "<b><span style='font-size : 2em'>$i</span> </b>";
                    }
                    else {
                        echo "<a href='./order_view.php?page=".$i."'><span style='font-size : 2em'>".$i."</span></a>";
                    }
                }

                if($page < $total_page){
                    $next = $page +1;
                        echo "<a href='./order_view.php?page=".$next."'><i class='fas fa-angle-right'></i></a>";
                        echo "<a href='./order_view.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
                else {
                    echo "<a href='./order_view.php?page=".$total_page."'><i class='fas fa-angle-right'></i></a>";
                    echo "<a href='./order_view.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
              }
                mysqli_close($conn);
                ?>
          </div>
          <div class="list_search_area">
            <form action="./order_view.php">
              <select class="slc_box" name="find_category" id="">
                <option value="o_id">주문 번호</option>
                <option value="mb_id">회원 ID</option>
                <option value="o_state">주문 상태</option>
                <option value="payment">결제 방식</option>
                <option value="o_date">주문 날짜</option>
              </select>
              <input type="text" class="search_word_box" name="find_word">
              <input type="submit" class="btn2" value="검색">
            </form>
          </div>
        </div>
      </div>
  </div>
</main>
</body>
<script src="../js/form_chk.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js?after"></script>
<script src="../js/sidebars.js?after"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="../js/btn_dropdown.js"></script>
</html>
