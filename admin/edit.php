<?php
include("../dbconn.php");
include("./admin_id_chk.php");

if($_GET['cate']=="product"){
  $p_id=trim($_GET['p_id']);
  $sql = "SELECT * FROM product where p_id = '$p_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
}
else{
  $n_id=trim($_GET['n_id']);
  $sql = "SELECT * FROM notice where n_id = '$n_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  //echo "<script>alert('$title');</script>";
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
      <p class="text1">수정/변경</p>
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
          <?php if($_GET['cate']=="product"){?>
            <p class="text3">상품 변경 하기</p>
          <?php }else { ?>
            <p class="text3">공지사항 수정 하기</p>
          <?php } ?>
          </div>
          <form enctype='multipart/form-data' action="../update.php" method="post">
          <div class="edit_table">
            <?php if($_GET['cate']=="product"){?>
              <input type="hidden" name="product" value="yes">
              <input type="hidden" name="p_id" value="<?php echo $p_id;?>">
            <table>
              <tr>
                <td class="col1">상품 번호</td>
                <td class="col2"><?php echo $row['p_id'];?></td>
              </tr>
              <tr>
                <td class="col1">이름</td>
                <td class="col2"><input type="text" name="p_name" value="<?php echo $row['p_name'];?>"></td>
              </tr>
              <tr>
                <td class="col1">가격</td>
                <td class="col2"><input type="text" name="p_price" value="<?php echo $row['p_price'];?>"></td>
              </tr>
              <tr>
                <td class="col1">수량</td>
                <td class="col2"><input type="text" name="p_amount" value="<?php echo $row['p_amount'];?>"></td>
              </tr>
              <tr>
                <td class="col3">상품이미지</td>
                <td class="col4"><img class="product_img" src=".<?php echo $row['img_path'].$row['p_id']; ?>.jpg" alt=""></td>
              </tr>
            </table>
            <?php } else {?>
              <input type="hidden" name="notice" value="yes">
              <input type="hidden" name="n_id" value="<?php echo $n_id;?>">
              <table>
              <tr>
                <td class="col1">공지 번호</td>
                <td class="col2"><?php echo $row['n_id'];?></td>
              </tr>
              <tr>
                <td class="col1">아이디</td>
                <td class="col2"><input type="text" name="mb_id" value="<?php echo $row['mb_id'];?>"></td>
              </tr>
              <tr>
                <td class="col1">날짜</td>
                <td class="col2"><?php echo $row['n_date'];?></td>
              </tr>
              <tr>
                <td class="col1">제목</td>
                <td class="col2"><input type="text" name="title" value="<?php echo $row['title'];?>" style="width:660px"></td>
              </tr>
              <tr>
                <td class="col3">글 내용</td>
                <td class="col4">
                <textarea name="content" style="resize: none; width:660px; height:280px; padding:5px;"><?php echo $row['content'];?>
                </textarea></td>
              </tr>
              <tr>
                <td class="col1">첨부된 이미지</td>
                <?php if(isset($row['n_img_path'])){?>
                <td class="col2"><?php echo $row['n_img_path'].$row['n_id']."jpg";?></td>
                <?php } else {?>
                  <td class="col2">첨부된 이미지가 없습니다.</td>
                <?php } ?>
              </tr>
            </table>
            <?php }?>
          </div>
          <div>
            <table class="img_update_btn_table">
            <?php if($_GET['cate']=="product"){ ?>
                <tr>
                  <td class="col1" style="font-size:1.1em;">상품 이미지 수정</td>
                  <td class="col2" style="padding-left:10px;">
                    <input type='file' name='img_update'>
                  </td>
                </tr>
                <tr>
                  <td class="col1" style="font-size:1.1em;">상품</br>상세 이미지 수정</td>
                  <td class="col2" style="padding-left:10px;">
                    <input type='file' name='detail_product_img_update'>
                  </td>
                </tr>
              <?php }else {?>
                <tr>
                  <td class="col1" style="font-size:1.1em;">공지사항 이미지 추가/수정</td>
                  <td class="col2" style="padding-left:10px;">
                  <input type='file' name='img_update'>
                  </td>
                </tr>
              <?php }?>
            </table>
            <ul class="btn_area">
              <li><input type="submit" class="btn1" value="수정하기"></li>
            </ul>
          </div>
          </form>
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
