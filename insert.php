<?php
include("./dbconn.php");
include("./function.php");
date_default_timezone_set('Asia/Seoul');
//상품 추가& 공지사항 추가

$n_date = date("Y-m-d H:i:s");

if(isset($_POST['insert'])){
    if($_POST['insert'] == "product"){
        $p_id = trim($_POST['p_id']);
        $p_name = trim($_POST['p_name']);
        $p_price = trim($_POST['p_price']);
        $category = trim($_POST['category']);
        $p_amount = trim($_POST['p_amount']);
        $img_path = "./img/product_img/";
        $detail_img_path = "./img/detail_img/";
        $sql = " INSERT INTO product
                    SET p_id = '$p_id',
                    p_name = '$p_name',
                    p_price = '$p_price',
                    p_amount = '$p_amount', 
                    img_path = '$img_path',
                    category  = '$category'
                    ";
        $result = mysqli_query($conn, $sql);
        $filename =  $p_id.".jpg";
        move_uploaded_file($_FILES['product_img']['tmp_name'], $img_path.$filename);
        move_uploaded_file($_FILES['product_detail_img']['tmp_name'], $detail_img_path.$filename);
        mysqli_close($conn);
        echo "<script>alert('추가되었습니다.');</script>";
        echo "<script>location.replace('./admin/product_view.php');</script>";
    }
    if($_POST['insert'] == "notice") {
        $n_id = trim($_POST['n_id']);
        $mb_id = "admin";
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $path = "./img/notice_img/";
        if ($_FILES['notice_img']['size'] == 0)
        {
            //파일이 없을 때
            $sql = " INSERT INTO notice
                    SET n_id = '$n_id',
                    mb_id = '$mb_id',
                    n_date = '$n_date',
                    title = '$title',
                    content = '$content'
                    ";
            $result = mysqli_query($conn, $sql);
        }else{
            //파일이 있을 때
            $sql = " INSERT INTO notice
                    SET n_id = '$n_id',
                    mb_id = '$mb_id',
                    n_date = '$n_date',
                    title = '$title',
                    content = '$content', 
                    n_img_path  = '$path'
                    ";
            $result = mysqli_query($conn, $sql);
            $filename =  $n_id.".jpg";
            move_uploaded_file($_FILES['notice_img']['tmp_name'], $path.$filename);
        }
        mysqli_close($conn);
        echo "<script>alert('추가되었습니다.');</script>";
        echo "<script>location.replace('./admin/notice_view.php');</script>";
    }
}
if(isset($_POST['ask_insert'])){
    $sql1 = "SELECT max(q_id) FROM qna";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $q_id=$row1[0]+1;
    $mb_id = trim($_POST['mb_id']);
    $q_title=  trim($_POST['q_title']);
    $q_content= trim($_POST['q_content']);
    $q_date = date("Y-m-d");
    $sql = " INSERT INTO qna
                    SET q_id = '$q_id',
                    mb_id = '$mb_id',
                    q_title = '$q_title',
                    q_content = '$q_content',
                    q_date = '$q_date'
                    ";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo "<script>alert('추가되었습니다.');</script>";
    echo "<script>location.replace('./store/ask.php');</script>";
}
?>