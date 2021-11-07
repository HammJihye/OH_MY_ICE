<?php
include("../dbconn.php");
include("./admin_id_chk.php");

$cate = trim($_GET['cate']);
if($_GET['cate'] == "product"){
  $case = 1;
  $table_title_text = "상품 추가하기";
  $sql = "SELECT max(p_id) FROM product";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $p_id=$row[0]+1;
}
if($_GET['cate'] == "notice"){
  $case = 2;
  $table_title_text = "공지사항 추가하기";
  $sql = "SELECT max(n_id) FROM notice";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $n_id=$row[0]+1;
}
if(strpos($cate, "answer") !== FALSE){
  $q_id = trim($_GET['q_id']);
  if($cate == "answer_insert"){
    //답변 입력
    $case = 3;
    $table_title_text = "답변 입력하기";
  }
  else{
    //답변 수정
    $table_title_text = "답변 수정하기";
    $case = 4;
  }
  $sql = "SELECT * from qna where q_id = '".$q_id."'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
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
      <p class="text1">추가하기</p>
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
            <p class="text3"><?php echo $table_title_text;?></p>
          </div>
          <?php if($case == 3 || $case == 4){?>
            <form action="../update.php" method="post">
          <?php } else {?>
            <form enctype='multipart/form-data' action="../insert.php" method="post" onsubmit="return fproduct_insert_submit(this);">
          <?php } ?>
          <?php if( $cate == "product") { ?>
          <div class="edit_table">
              <input type="hidden" name="insert" value="product">
              <input type="hidden" name="p_id" value="<?php echo $p_id;?>">
            <table>
              <tr>
                <td class="col1">상품 번호</td>
                <td class="col2"><?php echo $p_id;?></td>
              </tr>
              <tr>
                <td class="col1">이름</td>
                <td class="col2"><input type="text" name="p_name"></td>
              </tr>
              <tr>
                <td class="col1">가격</td>
                <td class="col2"><input type="text" name="p_price"></td>
              </tr>
              <tr>
                <td class="col1">수량</td>
                <td class="col2"><input type="text" name="p_amount"></td>
              </tr>
              <tr>
                <td class="col1">상품이미지</td>
                <td class="col2"><input style="margin-left:5px;" type='file' name='product_img' id="product_img" style="margin-left:-10px;"></td>
              </tr>
              <tr>
                <td class="col1">상품 디테일 이미지</td>
                <td class="col2"><input style="margin-left:5px;" type='file' name='product_detail_img' id="product_detail_img" style="margin-left:-10px;"></td>
              </tr>
              <tr>
                <td class="col1">카테고리</td>
                <td class="col2">
                  <select name="category">
                    <option value="ice">Ice cream</option>
                    <option value="beverage">Beverage</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <?php } else if($cate =="notice") {?>
            <div class="edit_table">
              <input type="hidden" name="insert" value="notice">
              <input type="hidden" name="n_id" value="<?php echo $n_id;?>">
            <table>
              <tr>
                <td class="col1">상품 번호</td>
                <td class="col2"><?php echo $n_id;?></td>
              </tr>
              <tr>
                <td class="col1">제목</td>
                <td class="col2"><input type="text" name="title"></td>
              </tr>
              <tr>
                <td class="col3">글 내용</td>
                <td class="col4"><textarea name="content" style="resize: none; width:660px; height:280px; padding:10px;"></textarea></td>
              </tr>
              <tr>
                <td class="col1">상품이미지</td>
                <td class="col2"><input style="margin-left:5px;" type='file' name='notice_img' id="notice_img" style="margin-left:-10px;"></td>
              </tr>
            </table>
            </div>
          <?php } else if($case == 3 || $case == 4){?>
            <!-- 답변 입력과 수정-->
            <input type="hidden" name="q_id" value="<?php echo $q_id;?>">
            <input type="hidden" name="anwser_where" value="admin">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id;?>">
            <div class="edit_table">
            <table>
              <tr>
                <td class="col1">번호</td>
                <td class="col2"><?php echo $q_id;?></td>
              </tr>
              <tr>
                <td class="col1">제목</td>
                <td class="col2"><?php echo $row['q_title'];?></td>
              </tr>
              <tr>
                <td class="col1">날짜</td>
                <td class="col2"><?php echo $row['q_date'];?></td>
              </tr>
              <tr>
                <td class="col7">글 내용</td>
                <td class="col8" style="padding:10px;">
                  <?php echo nl2br($row['q_content']);?>  
                </td>
              </tr>
            </table>
            </div>
            <div class="answer_table">
            <table>
              <tr>
                <td class="col3">답변</td>
                <td class="col4">
                <?php if($case == 3) {?>
                  <input type="hidden" name="qna_update" value="answer_insert_admin">
                  <textarea name="ad_content" style="resize: none; width:660px; height:280px; padding:10px;"></textarea>
                <?php }else { ?>
                  <input type="hidden" name="qna_update" value="answer_update_admin">
                  <textarea name="ad_content" style="resize: none; width:660px; height:280px; padding:10px;"><?php echo $row['ad_content'];?></textarea>
                <?php } ?>
                </td>
              </tr>
            </table>
            </div>
          <?php } ?>
          <div class="btn_box">
            <?php if($case == 4){?>
              <input type="submit" class="btn1" value="수정하기"></li>
            <?php } else {?>
              <input type="submit" class="btn1" value="입력하기"></li>
            <?php }?>
          </div>
          </form>
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
