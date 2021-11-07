<?php
include("./dbconn.php");

if(isset($_POST['delete_basket'])){
   //장바구니목록 선택 삭제
   $delArr = $_POST['chk'];

   for ($i=0;$i<sizeof($delArr);$i++) {
      $b_id = $delArr[$i];
      $sql1 = "DELETE FROM basket where b_id = '".$b_id."'"; //문의사항
      $result1 = mysqli_query($conn, $sql1);
   }
   echo "<script>alert('삭제되었습니다.');</script>";
   echo "<script>location.replace('./mypage/basket_list.php');</script>";
}
if(isset($_POST['delete_ask'])){
   //문의내역 선택 삭제
   $delArr = $_POST['chk'];

   for ($i=0;$i<sizeof($delArr);$i++) {
      $q_id = $delArr[$i];
      $sql1 = "DELETE FROM qna where q_id = '".$q_id."'"; //문의사항
      $result1 = mysqli_query($conn, $sql1);
   }
   echo "<script>alert('삭제되었습니다.');</script>";
   echo "<script>location.replace('./mypage/myasklist.php');</script>";
}
if(isset($_POST['delete_ask_all'])){
   //문의내역 전체 삭제
   $mb_id = trim($_POST['mb_id']);
   $sql1 = "DELETE FROM qna where mb_id = '".$mb_id."'"; //문의사항
   $result1 = mysqli_query($conn, $sql1);
   echo "<script>alert('삭제되었습니다.');</script>";
   echo "<script>location.replace('./mypage/myasklist.php');</script>";
}
if(isset($_GET['cate'])){
   $mode = trim($_GET['cate']);
   if($mode == "member"){
      $mb_id = trim($_GET['mb_id']);
   }
}
if(isset($_POST['leave_id'])){
   $mode = trim($_POST['leave_id']);
   $mb_id = trim($_POST['mb_id']);
}
if(isset($mode)){
   if($mode =="product"){
      $p_id = trim($_GET['p_id']);
      $sql1 = "SELECT * from order_detail where p_id = '".$p_id."'";
      $result_Count = mysqli_query($conn,$sql1);
      $total_record1 = mysqli_num_rows($result_Count);
      $sql1 = "SELECT * from basket where p_id = '".$p_id."'";
      $result_Count = mysqli_query($conn,$sql1);
      $total_record2 = mysqli_num_rows($result_Count);
      if($total_record1 == 0 && $total_record2 == 0){
         //product 삭제 가능
         $sql2 = "DELETE FROM product where p_id = '".$p_id."'";
         $result = mysqli_query($conn, $sql2);
         echo "<script>alert('삭제되었습니다.');</script>";
         echo "<script>location.replace('./admin/product_view.php');</script>";
      }
      else{
         echo "<script>alert('다른테이블에서 참조하기 있어 삭제되지 않습니다.');</script>";
         echo "<script>location.replace('./admin/product_view.php');</script>";
      }
   }
   if($mode == "member"){
      $sql1 = "DELETE FROM qna where mb_id = '".$mb_id."'"; //문의사항
      $result1 = mysqli_query($conn, $sql1);
      $sql2 = "DELETE FROM request where mb_id = '".$mb_id."'"; //환불요청
      $result2 = mysqli_query($conn, $sql2);
      $sql3 = "SELECT * from orders where mb_id = '".$mb_id."'";
      $result3 = mysqli_query($conn,$sql3);
      while($o_row = mysqli_fetch_array($result3)) {
         $o_id=$o_row['o_id'];
         $sql4 = "DELETE FROM recipient where o_id = '".$o_id."'";//받는 사람정보
         $result4 = mysqli_query($conn, $sql4);
         $sql5 = "DELETE FROM order_detail where o_id = '".$o_id."'";//주문 세부사항
         $result5 = mysqli_query($conn, $sql5);
      }
      $sql6 = "DELETE FROM orders where mb_id = '".$mb_id."'";//주문내역
      $result6 = mysqli_query($conn, $sql6);
      $sql7 = "DELETE FROM basket where mb_id = '".$mb_id."'";//장바구니 내역
      $result7 = mysqli_query($conn, $sql7);
      $sql8 = "DELETE FROM member where mb_id = '".$mb_id."'";//회원 삭제
      $result8 = mysqli_query($conn, $sql8);
      echo "<script>alert('삭제되었습니다.');</script>";
      session_unset();
      session_destroy();
      echo "<script>location.replace('./index.php');</script>";
   }
   if($mode == "order"){
      $o_id = trim($_GET['o_id']);
      $sql4 = "DELETE FROM recipient where o_id = '".$o_id."'";//받는 사람정보
      $result4 = mysqli_query($conn, $sql4);
      $sql5 = "DELETE FROM order_detail where o_id = '".$o_id."'";//주문 세부사항
      $result5 = mysqli_query($conn, $sql5);
      $sql6 = "DELETE FROM request where o_id = '".$o_id."'";//주문 세부사항
      $result6 = mysqli_query($conn, $sql6);
      $sql7 = "DELETE FROM orders where o_id = '".$o_id."'";//주문내역
      $result7 = mysqli_query($conn, $sql7);
      echo "<script>alert('삭제되었습니다.');</script>";
      echo "<script>location.replace('./admin/order_view.php');</script>";
   }
   if($mode == "request"){
      $r_id = trim($_GET['r_id']);
      $sql1 = "DELETE FROM request where r_id = '".$r_id."'";
      $result1 = mysqli_query($conn, $sql1);
      echo "<script>alert('삭제되었습니다.');</script>";
      echo "<script>location.replace('./admin/order_request.php');</script>";
   }
   if($mode == "notice"){
      $n_id = trim($_GET['n_id']);
      $sql1 = "DELETE FROM notice where n_id = '".$n_id."'";
      $result1 = mysqli_query($conn, $sql1);
      echo "<script>alert('삭제되었습니다.');</script>";
      echo "<script>location.replace('./admin/notice_view.php');</script>";
   }
   if($mode == "qna"){
      $q_id = trim($_GET['q_id']);
      $sql1 = "DELETE FROM qna where q_id = '".$q_id."'";
      $result1 = mysqli_query($conn, $sql1);
      echo "<script>alert('삭제되었습니다.');</script>";
      echo "<script>location.replace('./admin/qna_view.php');</script>";
   }
}
?>