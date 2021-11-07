<?php
include("../dbconn.php");
include("../function.php");
include("./admin_id_chk.php");

$now_month=date("m");
$search_month = "-".$now_month."-";
$month=$now_month;
$graph_month=$now_month;
$period = "1WEEK";
$graph_search_month = $search_month;

if(isset($_GET['search_word'])){
  //몇 월인지 검색했다면
  $search_month = "-".$_GET['search_month']."-";
  $month = $_GET['search_month'];
}

//데이터가 있는 월만 출력
$sql_ = "SELECT distinct SUBSTRING(o_date, 6, 2) as month from orders where refund_complete = 0 order by o_date asc";
$result_ = mysqli_query($conn,$sql_);

//페이지 나눌 총 합계
  $sql = "SELECT * from orders where o_date like '%".$search_month."%' and refund_complete = 0 group by o_date";
  $resultCount = mysqli_query($conn,$sql);
  $total_record =  mysqli_num_rows($resultCount);

  $list = 10;
  $block_cnt =5;
  $block_num= ceil($page / $block_cnt);
  $block_start = (($block_num-1) * $block_cnt) +1;
  $block_end = $block_start + $block_cnt -1;

  $total_page = ceil($total_record / $list);
  $page_start = ($page - 1) * $list;

  //일간 매출액
  $sql2 = "SELECT o_date, sum(o_price) as revenue from orders as o join order_detail as od on o.o_id=od.o_id where o_date like '%".$search_month."%' and refund_complete = 0 group by o_date order by o_date asc limit ".$page_start.",".$list."";
  $result = mysqli_query($conn,$sql2);
  
  //총 합계
  $sql3 = "SELECT sum(o_price) as total_price from orders as o join order_detail as od on o.o_id=od.o_id where o_date like '%".$search_month."%' and refund_complete = 0";
  $result3 = mysqli_query($conn,$sql3);
  $total_row = mysqli_fetch_array($result3);
  $monthly_revenue = $total_row["total_price"];
if(isset($_GET['best_product'])){
  $period=trim($_GET['period']);
}

switch ($period){
  case "1WEEK" : $sql4 = "SELECT o_date,p_name, sum(o_amount) as rank_amount from orders as o join order_detail as od on o.o_id=od.o_id join product as p on od.p_id=p.p_id where o_date BETWEEN DATE_ADD(NOW(),INTERVAL -1 WEEK ) AND NOW() group by od.p_id order by rank_amount desc limit 0, 10";
                  $period_text = "이번 주의";$color="#8EDDED";break;
  case "1MONTH" : $sql4 = "SELECT o_date,p_name, sum(o_amount) as rank_amount from orders as o join order_detail as od on o.o_id=od.o_id join product as p on od.p_id=p.p_id where o_date BETWEEN DATE_ADD(NOW(),INTERVAL -1 MONTH ) AND NOW() group by od.p_id order by rank_amount desc limit 0, 10";
                  $period_text = "이번 달의";$color="#8EDDED";break;
  case "3MONTH" : $sql4 = "SELECT o_date,p_name, sum(o_amount) as rank_amount from orders as o join order_detail as od on o.o_id=od.o_id join product as p on od.p_id=p.p_id where o_date BETWEEN DATE_ADD(NOW(),INTERVAL -3 MONTH ) AND NOW() group by od.p_id order by rank_amount desc limit 0, 10";
                  $period_text = "세 달동안의";$color="#8EDDED";break;
}
$result4 = mysqli_query($conn,$sql4);

//그래프 월 검색을 눌렀다면
if(isset($_GET['graph_search_word'])){
  $graph_search_month = "-".$_GET['graph_search_month']."-";
  $graph_month = $_GET['graph_search_month'];
}

//그래프
$sql5 = "SELECT replace(o_date, '2021-', '') as date, sum(o_price) as revenue from orders as o join order_detail as od on o.o_id=od.o_id where o_date like '%".$graph_search_month."%' and refund_complete = 0 group by o_date order by o_date asc";
//결과를 변수에 할당
$result5 = mysqli_query($conn,$sql5);
//배열에 출력된 배열을 담기(모든 데이터)
while($row=mysqli_fetch_assoc($result5)){
    $data_array[] = ($row);
}
//배열을 json으로 encode 해서 변수에 할당
$chart = json_encode($data_array);


$j=1;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
      <p class="text1">판매량 보기</p>
      <form action="">
      <div class="search_area">
          <input type="text" class="input_text" placeholder="Search">
          <input type="submit" class="submit_btn" value="&#xf002;">
      </div>
    </form>
    </div>
      <div class="main">
        <div class="content">
          <div class="table_title" style="border-bottom:1px solid black;">
            <p class="text3">매출액 / BEST 상품</p>
          </div>
          <div class="graph_title_text">
            <p class="text6"><?php echo $graph_month;?>월 매출액</p>
          </div>
          <div class="graph_searh_month_btn_wrap">
            <!-- 일일 매출액(월) 그래프 폼-->
            <form action="./sales_rate.php">
              <?php if(isset($_GET['search_word'])){?>
                  <input type="hidden" name="search_word" value="month">
                  <input type="hidden" name="search_month" value="<?php echo $month;?>">
              <?php }?>
              <?php if(isset($_GET['best_product'])){?>
                  <input type="hidden" name="best_product" value="y">
                  <input type="hidden" name="period" value="<?php echo $period;?>">
              <?php }?>
              <input type="hidden" name="graph_search_word" value="y">
              <div class="search_month_info">
                <select name="graph_search_month" style="width:80px;margin-right:10px;">
                  <option value="<?php echo $now_month;?>">선택</option>
                  <?php while($month_row = mysqli_fetch_array($result_)) {?>
                    <option value="<?php echo $month_row['month'];?>"><?php echo $month_row['month'];?>월</option>  
                  <?php }?>
                </select>
                <input type="submit" class="month_search_btn" value="검색">
              </div>
            </form>
          </div>
          <div id="chartOfMine" style="width: 1200px; height: 500px;"></div> <!-- 그래프 -->
          <div class="sales_rate_info_wrapper">
            <div class="revenue_table_wrap">
                <p class="text5"><?php echo $month; ?>월 매출액</p>
              <!--일일 매출액(월) 표 폼 -->
              <form action="./sales_rate.php">
                <?php if(isset($_GET['graph_search_word'])){?>
                  <input type="hidden" name="graph_search_word" value="y">
                  <input type="hidden" name="graph_search_month" value="<?php echo $graph_month;?>">
                <?php }?>
                <?php if(isset($_GET['best_product'])){?>
                  <input type="hidden" name="best_product" value="y">
                  <input type="hidden" name="period" value="<?php echo $period;?>">
                <?php }?>
              <input type="hidden" name="search_word" value="month">
              <div class="search_month_info">
                <select name="search_month" style="width:80px;margin-right:10px;">
                  <?php for($i=0; $i<13; $i++){
                    if($i==0){
                    ?>
                    <option value="<?php echo $now_month;?>">선택</option>
                    <?php } else if($i < 10) {?>
                    <option value="<?php echo "0".$i;?>"><?php echo $i;?>월</option>
                  <?php } else{ ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?>월</option>   
                  <?php }}?>
                </select>
                <input type="submit" class="month_search_btn" value="검색">
              </div>
              </form>
              <table class="revenue_table">
                <tr class="col11"><th>날짜</th><th>매출액</th></tr>
                <?php while($row = mysqli_fetch_array($result)) {
                ?>
                  <tr class="col12">
                    <td><?php echo $row['o_date'];?></td>
                    <td><?php echo number_format($row['revenue']);?>원</td>
                  </tr>
                <?php }?>
                <tr class="col12">
                  <td>합계</td>
                  <td><?php echo number_format($monthly_revenue);?>원</td>
                </tr>
              </table>
              <div class="revenue_page_btn">
              <?php
              if(isset($_GET['search_word'])){
                if ($page > 1){
                  echo "<a href='./sales_rate.php?search_word=month&search_month=".$month."&page=1'><i class='fas fa-angle-double-left'></i></a>";
                  $pre = $page -1;
                  echo "<a href='./sales_rate.php?search_word=month&search_month=".$month."&page=".$pre."'><i class='fas fa-angle-left'></i></a>";
                }
                else {
                    echo "<a href='./sales_rate.php?search_word=month&search_month=".$month."&page=1'><i class='fas fa-angle-double-left'></i></a>";
                    echo "<a href='./sales_rate.php?search_word=month&search_month=".$month."&page=1'><i class='fas fa-angle-left'></i></a>";
                }
                
                if($total_page < $block_cnt){
                    $block_end = $total_page;
                }
                
                for($i = $block_start; $i <= $block_end; $i++){
                    if($page == $i){
                        echo "<b><span>$i</span> </b>";
                    }
                    else {
                        echo "<a href='./sales_rate.php?search_word=month&search_month=".$month."&page=".$i."'><span >".$i."</span></a>";
                    }
                }

                if($page < $total_page){
                    $next = $page +1;
                        echo "<a href='./sales_rate.php?search_word=month&search_month=".$month."&page=".$next."'><i class='fas fa-angle-right'></i></a>";
                        echo "<a href='./sales_rate.php?search_word=month&search_month=".$month."&page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
                else {
                    echo "<a href='./sales_rate.php?search_word=month&search_month=".$month."&page=".$total_page."'><i class='fas fa-angle-right'></i></a>";
                    echo "<a href='./sales_rate.php?search_word=month&search_month=".$month."&page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
              }
              else{
                if ($page > 1){
                        echo "<a href='./sales_rate.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                        $pre = $page -1;
                        echo "<a href='./sales_rate.php?page=".$pre."'><i class='fas fa-angle-left'></i></a>";
                }
                else {
                    echo "<a href='./sales_rate.php?page=1'><i class='fas fa-angle-double-left'></i></a>";
                    echo "<a href='./sales_rate.php?page=1'><i class='fas fa-angle-left'></i></a>";
                }
                
                if($total_page < $block_cnt){
                    $block_end = $total_page;
                }
                
                for($i = $block_start; $i <= $block_end; $i++){
                    if($page == $i){
                        echo "<b><span>$i</span> </b>";
                    }
                    else {
                        echo "<a href='./sales_rate.php?page=".$i."'><span >".$i."</span></a>";
                    }
                }

                if($page < $total_page){
                    $next = $page +1;
                        echo "<a href='./sales_rate.php?page=".$next."'><i class='fas fa-angle-right'></i></a>";
                        echo "<a href='./sales_rate.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
                else {
                    echo "<a href='./sales_rate.php?page=".$total_page."'><i class='fas fa-angle-right'></i></a>";
                    echo "<a href='./sales_rate.php?page=".$total_page."'><i class='fas fa-angle-double-right'></i></a>";
                }
              }
                mysqli_close($conn);
                ?>
              </div>
            </div>
            <div class="best_sales_table_wrap">
              <p class="text5"><span style="margin-right:10px;"><?php echo $period_text;?></span>BEST 상품</p>
              <div class="date_btn_list_wrap">
                <form action="./sales_rate.php">
                <input type="hidden" name="best_product" value="y">
                <ul class="date_btn_list">
                <?php if(isset($_GET['graph_search_word'])){?>
                  <input type="hidden" name="graph_search_word" value="y">
                  <input type="hidden" name="graph_search_month" value="<?php echo $graph_month;?>">
                <?php }?>
                <?php if(isset($_GET['search_word'])){?>
                  <input type="hidden" name="search_word" value="month">
                  <input type="hidden" name="search_month" value="<?php echo $month;?>">
                <?php }?>
                  <li><input type="submit" class="date_btn" name="period" value="1WEEK"></li>
                  <li><input type="submit" class="date_btn" name="period" value="1MONTH"></li>
                  <li><input type="submit" class="date_btn" name="period" value="3MONTH"></li>
                </ul>
                </form>
              </div>
              <table class="best_sales_table">
                <tr class="col11"><th>순위</th><th>상품명</th><th>수량</th></tr>
                <?php while($best_product_row = mysqli_fetch_array($result4)) {
                ?>
                  <tr class="col12">
                    <td><?php echo $j;?></td>
                    <td><?php echo $best_product_row['p_name'];?></td>
                    <td><?php echo $best_product_row['rank_amount'];?></td>
                  </tr>
                <?php $j++; } ?>
              </table>
            </div>
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
<script type="text/javascript">

google.charts.load('current', {'packages': ['corechart']});
google.charts.setOnLoadCallback(drawVisualization);

function drawVisualization() {
    var chart_array = <?php echo $chart; ?>; //차트에 넣는 데이터
    var header = ['date', 'revenue']; //헤더 종류에 대한 배열
    var row = "";
    var rows = new Array();
    jQuery.each(chart_array, function (i, d) {
        row = [
            d.date,    //출력되는 데이터1
            Number(d.revenue)    //출력되는 데이터2
        ];
        rows.push(row);    //rows 에 row(배열)을 push 하기 
    });
    var jsonData = [header].concat(rows);
//data 설정 끝
    var data = google.visualization.arrayToDataTable(jsonData);
    var options = {
        title: '',
        vAxis: {
            title: 'Revenue'    //y 축 이름
        },
        hAxis: {
            title: 'Date'   //x 축 이름
        },
        seriesType: 'bars',
        showRowNumber: 'false'
    };
    var chart = new google.visualization.ComboChart(document.getElementById('chartOfMine'));
    chart.draw(data, options);
}

</script>
</html>
