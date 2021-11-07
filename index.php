<?php
include("./dbconn.php");
include("./function.php");
if(isset($_SESSION['ss_mb_id'])){
    $user_id = trim($_SESSION['ss_mb_id']); 
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
    <title>OH MY ICE</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Gothic+A1:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/index_style.css?after">

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
    <link href="./css/carousel.css" rel="stylesheet">
  </head>
  <body>
  <div class="header">
        <div class="top">
            <div class="logo_image">
                <a href=""><p class="logo_text">OH MY <span class="ice_text">ICE</span></p></a>
            </div>
            <ul class="logo_nav">
                <li><a href="./product.php?menu=ice">PRODUCT</a></li>
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
                </li>
            </ul>
        </div>
  </div>
<main>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="bd-placeholder-img" width="100%" height="100%" src="./img/header001.jpg" alt="">
      </div>
      <div class="carousel-item">
        <a href="#"><img class="bd-placeholder-img" width="100%" height="100%" src="./img/header002.jpg" alt=""></a>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="100%" src="./img/header003.jpg" alt="">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
        <a href="./product.php?menu=ice">
          <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="./img/new_logo.jpg" alt="" style="border:1px solid #eaeaea;">
        </a>

        <h2 class="title_txt1">NEW PRODUCT</h2>
        <p><a class="btn btn-secondary" href="./product.php?menu=ice" style="margin-top:10px; font-family: 'Gothic A1', sans-serif;">신상품 보러가기 &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <a href="./product.php?menu=ice">
          <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="./img/product_img.jpg" alt="" style="border:1px solid #eaeaea;">
        </a>

      <h2 class="title_txt1"> PRODUCT</h2>
        <p><a class="btn btn-secondary" href="product.php?menu=ice" style="margin-top:10px; font-family: 'Gothic A1', sans-serif;">상품 보러가기 &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <a href="">
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="./img/event_logo.jpg" alt="" style="border:1px solid #eaeaea;">
          </a>

        <h2 class="title_txt1">EVENT</h2>
        <p><a class="btn btn-secondary" href="#" style="margin-top:10px; font-family: 'Gothic A1', sans-serif;">이벤트 보러가기 &raquo;</a></p>
      </div>
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">아이스크림의 기준, OH MY <span style="color:#AFE1FF;">ICE</span></h2>
        <p class="lead" style="margin-top:30px;">더 많은 아이스크림이 알고 싶다면 클릭하세요!</p>
      </div>
      <div class="col-md-5">
        <a href="./product.php?menu=ice">
          <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="./img/ice_logo_img.jpg" alt="">
        </a>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading">아이스크림으로 즐기는 OH MY <span style="color:#AFE1FF;">ICE</span>만의 음료!</h2>
        <p class="lead" style="margin-top:30px;"> OH MY <span style="color:#AFE1FF;">ICE</span>만의 음료를 알고 싶다면 클릭하세요!</p>
      </div>
      <div class="col-md-5 order-md-1">
        <a href="./product.php?menu=beverage">
        <img  class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500"  src="./img/beverage_logo_img.jpg" alt="">
        </a>
      </div>
    </div>

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

</main>
  <div class="footer">
        <div>OH MY ICE</div>
        <div>
              사업자 등록번호 : 303-81-09535 비알코리아(주) 대표이사 도세호 서울특별시 서초구 남부순환로 2620(양재동 11-149번지)
                TEL : 080-555-3131 <br>
                개인정보관리책임자 : 김경우 <br>
              COPYRIGHT 2019. TAMO. ALL RIGHT RESERVED.
        </div>
    </div>

    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
