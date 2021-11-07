<?php
include("../dbconn.php");
include("./admin_id_chk.php");

$o_id=trim($_GET['o_id']);
if($_GET['cate'] == "request") {
  $r_id=trim($_GET['r_id']);
}
$sql = "SELECT * from orders where o_id = '$o_id'";
$result = mysqli_query($conn, $sql);
$o_row = mysqli_fetch_array($result);
$payment_word=$o_row['payment'];
$refund_complete =$o_row['refund_complete'];
$sql2 = "SELECT * from order_detail as od join product as p on od.p_id=p.p_id where o_id = '$o_id'";
$result2 = mysqli_query($conn, $sql2);
switch($payment_word){
  case 'kakaopay' : $payment="카카오페이";break;
  case 'account_transfer' : $payment="계좌이체";break;
  case 'credit_card' : $payment="신용/체크 카드";break;
  case 'corporation_card' : $payment="법인카드";break;
  case 'phone' : $payment="휴대폰";break;
  case 'despositor' : $payment="무통장 입금";break;
}
$sql3 = "SELECT * from recipient where o_id = '$o_id'";
$result3 = mysqli_query($conn, $sql3);
$r_row = mysqli_fetch_array($result3);
$total_price=0;
$total_amount=0;
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
    <link href="../css/admin.css?after" rel="stylesheet">
    <link href="../css/dashboard.css?after" rel="stylesheet">
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
      <p class="text1">상세보기</p>
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
            <p class="text3">상세 보기</p>
          </div>
          <div class="table_area1">
            <p class="text4">주문 상세 정보</p>
            <table class="detail_view_table">
              <tr>
                <td class="col5">주문번호</td>
                <td class="col6" colspan="3"><?php echo $o_id;?></td>
              </tr>
              <tr>
                <td class="col5">주문날짜</td>
                <td class="col6" colspan="3"><?php echo $o_row['o_date'];?></td>
              </tr>
              <tr>
                <td class="col5">회원 ID</td>
                <td class="col6" colspan="3"><?php echo $o_row['mb_id'];?></td>
              </tr>
              <tr>
                <td class="col5">주문 상태</td>
                <td class="col6" colspan="3"><?php echo $o_row['o_state'];?></td>
              </tr>
              <form action="../update.php" method="post">
              <tr>
                <?php if($_GET['cate'] == "order") {?>
                  <input type="hidden" name="o_state_update" value="admin">
                  <input type="hidden" name="o_id" value="<?php echo $o_id;?>">
                <td class="col5">주문 상태 수정</td>
                <td class="col6" colspan="3">
                  <select name="order_state_update" id="">
                    <option value="payment_complete">결제완료</option>
                    <option value="product_ready">상품 준비중</option>
                    <option value="ship_start">배송 시작</option>
                    <option value="shipping">배송 중</option>
                    <option value="delivery_complete">배송 완료</option>
                  </select>
                  <input type="submit" class="btn3" value="수정하기">
                </td>
                <?php } else {?>
                  <input type="hidden" name="r_state_update" value="admin">
                  <input type="hidden" name="o_id" value="<?php echo $o_id;?>">
                  <input type="hidden" name="r_id" value="<?php echo $r_id;?>">
                  <td class="col7">취소등 요청수정</td>
                <td class="col6" colspan="3">
                  <select name="request_respond" id="">
                    <option value="order_cancle_completed">주문취소완료</option>
                    <option value="refund_completed">환불완료</option>
                    <option value="return_completed">반품완료</option>
                    <option value="exchange_completed">교환완료</option>
                    <option value="request_cancle_completed">요청취소완료</option>
                  </select>
                  <?php if($refund_complete == 0){?>
                  <input type="submit" class="btn3" value="수정하기">
                  <?php } else{?>
                    <a href="" class="btn3" onClick="alert('수정할 수 없습니다.');">수정하기</a>
                  <?php }?>
                </td>
                <?php } ?>
              </tr>
              </form>
              <tr>
                <td class="col5">결제 방식</td>
                <td class="col6" colspan="3"><?php echo $payment;?></td>
              </tr>
              <tr>
                <td colspan="4" class="col9">주문 상품</td>
              </tr>
              <?php while($p_row = mysqli_fetch_array($result2)) { ?>
              <tr>
                  <td style="padding:10px;"><img class="product_img_box" src="<?php echo ".".$p_row['img_path'].$p_row['p_id']?>.jpg" alt=""></td>
                  <td class="col10"><?php echo $p_row['p_name'];?></td>
                  <td class="col10"><?php echo $p_row['o_amount'];?>개</td>
                  <td class="col10"><?php echo number_format($p_row['o_price']);?>원</td>
              </tr>
              <?php 
              $total_price += $p_row['o_price'];
              $total_amount += $p_row['o_amount'];
            }?>
              <tr>
                <td class="col9" colspan="2">합계</td>
                <td class="col10"><?php echo $total_amount;?>개</td>
                <td class="col10"><?php echo number_format($total_price);?>원</td>
              </tr>
            </table>
          </div>
          <?php if($refund_complete == 0){?>
          <div class="table_area2">
            <p class="text4">받는 사람 정보</p>
            <table class="recipient_info_table">
              <tr class="row1"><th>받는 사람</th><th>주소</th><th>연락처</th><th>요청 메시지</th></tr>
              <tr class="row2">
                <td><?php echo $r_row['recipient'];?></td><td><?php echo $r_row['final_address'];?></td>
                <td><?php echo $r_row['recipient_phone'];?></td><td><?php echo $r_row['ship_request'];?></td></tr>
            </table>
          </div>
          <?php }?>
          <div class="btn_box">
            <?php if($_GET['cate'] == "order") {?>
              <button class="back_btn" onClick="location.href='./order_view.php'">이전 페이지로</button>
            <?php } else {?>
              <button class="back_btn" onClick="location.href='./order_request.php'">이전 페이지로</button>
            <?php }?>
          </div>
        </div>
      </div>
  </div>
</main>
</body>
<script src="../assets/dist/js/bootstrap.bundle.min.js?after"></script>
<script src="../js/sidebars.js?after"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="../js/btn_dropdown.js"></script>
</html>
