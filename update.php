<?php
include("./dbconn.php");
include("./function.php");
//상품을 변경할 때
if(isset($_POST['product'])){
    $id = trim($_POST['p_id']);
    $p_name=trim($_POST['p_name']);
    $p_price=trim($_POST['p_price']);
    $p_amount=trim($_POST['p_amount']);
    $path = "./img/product_img/";
    $sql="UPDATE product set p_name='$p_name',p_price='$p_price', p_amount='$p_amount' where p_id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($_FILES['img_update']['size'] != 0){
        $filename =  $id.".jpg";
        move_uploaded_file($_FILES['img_update']['tmp_name'], $path.$filename);
    }
    if ($_FILES['detail_product_img_update']['size'] != 0){
        $path = "./img/detail_img/";
        $filename =  $id.".jpg";
        move_uploaded_file($_FILES['detail_product_img_update']['tmp_name'], $path.$filename);
    }
}
//공지를 변경할 때
if(isset($_POST['notice'])){
    $id = trim($_POST['n_id']);
    $mb_id = trim($_POST['mb_id']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $path = "./img/notice_img/";
    if ($_FILES['img_update']['size'] == 0)
    {
    //파일이 없을 때
    $sql="UPDATE notice set mb_id='$mb_id',title='$title', content='$content', n_date = now() where n_id='$id'";
    $result = mysqli_query($conn, $sql);
    }else{
    //파일이 있을 때
    $sql="UPDATE notice set mb_id='$mb_id',title='$title', content='$content', n_img_path='$path', n_date = now() where n_id='$id'";
    $result = mysqli_query($conn, $sql);
    $filename =  $id.".jpg";
    move_uploaded_file($_FILES['img_update']['tmp_name'], $path.$filename);
    }
}
if(isset($_POST['product'])){
    echo "<script>alert('수정되었습니다.');</script>";
    echo "<script>location.replace('./admin/product_view.php');</script>";
}
if(isset($_POST['notice'])){
    echo "<script>alert('수정되었습니다.');</script>";
    echo "<script>location.replace('./admin/notice_view.php');</script>";
}
//취소, 환불, 교환등 요청이 있을 때
if(isset($_POST['request'])){
    $request=trim($_POST['request']);
    $o_id=trim($_POST['o_id']);
    $sql1="SELECT o_state from orders where o_id='$o_id'";
    $result1 = mysqli_query($conn, $sql1);
    $row= mysqli_fetch_array($result1);
    $o_state = $row['o_state'];
    if($_POST['request'] == "delete" && $o_state != "요청취소"){
        $state = "요청취소";
        $sql="UPDATE orders set o_state = '$state' where o_id='$o_id'";
        $result = mysqli_query($conn, $sql);
        $sql2="UPDATE request set r_state = '$state' where o_id='$o_id'";
        $result2 = mysqli_query($conn, $sql2);
        mysqli_close($conn);
        echo "<script>alert('취소 되었습니다.');</script>";
        echo "<script>location.replace('./mypage/mypage.php');</script>";
    }
    else{
        $slc_reason=trim($_POST['reason']);
        $detail_reason=trim($_POST['detail_reason']);
        $bank=trim($_POST['bank']);
        $account_number=trim($_POST['account_num']);
        $account_name=trim($_POST['account_name']);
        switch($slc_reason){
            case "reorder" : $slc_reason_word="재주문 하기 위해";break;
            case "wrongorder" : $slc_reason_word="주문이 잘못되어서";break;
            case "changeofheart" : $slc_reason_word="마음이 바뀌어서";break;
            case "poorpackaging" : $slc_reason_word="포장이 불량이어서";break;
            case "deliverydelay" : $slc_reason_word="배송이 지연되어서";break;
            case "defectiveproduct" : $slc_reason_word="상품이 불량이어서";break;
            case "etc" : $slc_reason_word="기타";break;
        }
        $reason=$slc_reason_word." / ".$detail_reason;
        if(strpos($o_state, "취소") !==false || strpos($o_state, "요청") !==false){
            mysqli_close($conn);
            echo "<script>alert('이미 진행중인 요청이 있습니다.');</script>";
            echo "<script>location.replace('./mypage/mypage.php');</script>";
        }
        else{
            switch($request){
                case "cancle" : $state="취소요청";break;
                case "refund" : $state="환불요청";break;
                case "return" : $state="반품요청";break;
                case "exchange" : $state="교환요청";break;
            }
            $sql="UPDATE orders set o_state = '$state' where o_id='$o_id'";
            $result = mysqli_query($conn, $sql);
            $sql2 = " INSERT INTO request
                        SET mb_id = '$mb_id',
                        o_id = '$o_id',
                        r_state = '$state',
                        r_reason = '$reason',
                        bank = '$bank',
                        account_number = '$account_number',
                        account_name = '$account_name'
                        ";
            $result2 = mysqli_query($conn, $sql2);
            mysqli_close($conn);
            echo "<script>alert('요청 되었습니다.');</script>";
            echo "<script>location.replace('./mypage/mypage.php');</script>";
        }
    }
}
if(isset($_POST['request_update']) || isset($_POST['r_state_update'])){
    $r_id=trim($_POST['r_id']);
    $o_id=trim($_POST['o_id']);
    $request_respond=trim($_POST['request_respond']);
    switch ($request_respond){
        case 'order_cancle_completed' : $state="주문취소완료";break;
        case 'refund_completed' : $state="환불 완료";break;
        case 'return_completed' : $state="반품 완료";break;
        case 'exchange_completed' : $state="교환 완료";break;
        case 'request_cancle_completed' : $state="요청취소완료";break;
    }
    if($request_respond == "request_cancle_completed"){
        $o_state="결제완료";
        $sql="UPDATE orders set o_state = '$o_state' where o_id='$o_id'";
    }
    else{
        $sql_ = "SELECT *, p.p_id as pid from order_detail as od join product as p on od.p_id=p.p_id where o_id = '".$o_id."'";
        $result_ = mysqli_query($conn,$sql_);
        while($od_row_ = mysqli_fetch_array($result_)) {
            $p_amount = $od_row_['p_amount'] + $od_row_['o_amount'];
            $p_id = $od_row_['pid'];

            $p_sql="UPDATE product set p_amount ='$p_amount' where p_id='$p_id'";
            $p_result = mysqli_query($conn, $p_sql);
        }
        $sql4 = "DELETE FROM recipient where o_id = '".$o_id."'";//받는 사람정보
        $result4 = mysqli_query($conn, $sql4);

        $od_sql = "DELETE FROM order_detail where o_id = '".$o_id."'";//주문 세부사항
        $od_result = mysqli_query($conn, $od_sql);
        
        $sql="UPDATE orders set o_state = '$state', refund_complete = 1 where o_id='$o_id'";
    }
    $result = mysqli_query($conn, $sql);
    $sql2="UPDATE request set r_state = '$state' where r_id='$r_id'";
    $result2 = mysqli_query($conn, $sql2);
    mysqli_close($conn);
    echo "<script>alert('수정되었습니다.');</script>";
    echo "<script>location.replace('./admin/order_request.php');</script>";
}
if(isset($_POST['o_state_update'])){
    $o_id=trim($_POST['o_id']);
    $o_state=trim($_POST['order_state_update']);
    switch ($o_state){
        case 'payment_complete' : $state="결제완료";break;
        case 'product_ready' : $state="상품 준비중";break;
        case 'ship_start' : $state="배송 시작";break;
        case 'shipping' : $state="배송 중";break;
        case 'delivery_complete' : $state="배송 완료";break;
    }
    $sql="UPDATE orders set o_state = '$state' where o_id='$o_id'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo "<script>alert('수정되었습니다.');</script>";
    echo "<script>location.replace('./admin/order_view.php');</script>";
}
//qna 업데이트
if(isset($_POST['qna_update'])){
    $qna_update=trim($_POST['qna_update']);
    $q_id =trim($_POST['q_id']);
    if($qna_update =="ask"){//qna 사용자 수정
        $mb_id = trim($_POST['mb_id']);
        $q_title =trim($_POST['q_title']);
        $q_content =trim($_POST['q_content']);
        $q_date = date("Y-m-d");
        $sql="UPDATE qna set q_title = '$q_title', q_content = '$q_content', q_date='$q_date' where q_id='$q_id'";
        $result = mysqli_query($conn, $sql);
    }
    else{
        $ad_id = trim($_POST['admin_id']);
        $ad_content = trim($_POST['ad_content']);
        $anwser_where = trim($_POST['anwser_where']);

        $sql2="UPDATE qna set admin_id = '$ad_id', ad_content = '$ad_content', ad_whether = '1' where q_id='$q_id'";
        $result = mysqli_query($conn, $sql2);

        if($qna_update=="answer_insert_admin"){
            echo "<script>alert('입력되었습니다.');</script>";
        }
        else{
            echo "<script>alert('수정되었습니다.');</script>";
        }
        if($anwser_where == "user"){
            echo "<script>location.replace('./store/ask.php');</script>";
        }
        else{
            echo "<script>location.replace('./admin/qna_view.php');</script>";
        }
    }
    mysqli_close($conn);
    echo "<script>alert('수정되었습니다.');</script>";
    echo "<script>location.replace('./store/ask.php');</script>";
}
//마이페이지 > 내 정보 변경
if(isset($_POST['myinfo_update'])){
    $mb_id = trim($_POST['mb_id']);
    $mb_pwd = trim($_POST['mb_pwd']);
    $mb_name = trim($_POST['mb_name']);
    $mb_email = trim($_POST['mb_email']);
    $mb_phone = trim($_POST['mb_phone']);
    $mb_gender = trim($_POST['mb_gender']);
    $mb_postcode = trim($_POST['mb_postcode']);
    if($_POST['change_address'] == null){
        $mb_address = trim($_POST['mb_address']);
    }
    else{
        $mb_address = trim($_POST['change_address'])." ".trim($_POST['change_detailAddress']);  
    }
    $sql="UPDATE member set mb_pwd = '$mb_pwd', mb_name = '$mb_name', mb_email ='$mb_email',  mb_phone = '$mb_phone',  mb_gender = '$mb_gender', mb_address = '$mb_address' where mb_id ='$mb_id'";
    $result = mysqli_query($conn, $sql);
    echo "<script>alert('변경되었습니다.');</script>";
    echo "<script>location.replace('./mypage/myinfo/myinfo.php');</script>";
}
//마이페이지 > 나의 배송지 관리 - 내 주소 변경
if(isset($_POST['myadd_update'])){
    $mb_id = trim($_POST['mb_id']);
    $mb_address = trim($_POST['mb_address'])." ".trim($_POST['mb_detailAddress']);
    $sql="UPDATE member set mb_address = '$mb_address' where mb_id ='$mb_id'";
    $result = mysqli_query($conn, $sql);
    echo "<script>alert('변경되었습니다.');</script>";
    echo "<script>location.replace('./mypage/myinfo/myaddress.php');</script>";
}
//주문상세 > 받는사람 정보 변경
if(isset($_POST['recipient_info_update'])){
    $o_id = trim($_POST['o_id']);
    $recipient =  trim($_POST['recipient']);
    $recipient_phone =  trim($_POST['recipient_phone']);
    $mb_postcode = trim($_POST['mb_postcode']);
    $final_address = trim($_POST['mb_address'])." ".trim($_POST['mb_detailAddress']);
    $ship_request = trim($_POST['ship_request']);

    $sql="UPDATE recipient set recipient = '$recipient', final_address = '$final_address', recipient_phone ='$recipient_phone', ship_request = '$ship_request' where o_id ='$o_id'";
    $result = mysqli_query($conn, $sql);
    echo "<script>alert('변경되었습니다.');</script>";
    echo "<script>location.replace('./mypage/order_detail_view.php?o_id=$o_id');</script>";
}
if(isset($_POST['request_selected_cancle'])){
    $update_Arr = $_POST['chk'];
    $o_state = "결제완료";
    $r_state = "요청취소완료";
    $case = 1;

   for ($i=0;$i<sizeof($update_Arr);$i++) {
        $o_id = $update_Arr[$i];
        if($o_id != "selectAll"){
            $sql = "SELECT o_state from orders where o_id = '".$o_id."'";
            $result = mysqli_query($conn,$sql);
            $o_row = mysqli_fetch_array($result);
            if(strpos($o_row['o_state'], "완료") !== false){
                //완료가 포함되어 있을 시에 == 이미 취소완료된 것인데 한번더 요청취소를 눌렀다
                $case=2;
            }
            else{
                $sql1="UPDATE orders set o_state = '$o_state' where o_id ='$o_id'";
                $result1 = mysqli_query($conn, $sql1);
                $sql2="UPDATE request set r_state = '$r_state' where o_id ='$o_id'";
                $result2 = mysqli_query($conn, $sql2);
            }
        }
   }
   if($case == 1 ){
       //요청 취소했을 시에
        echo "<script>alert('변경되었습니다.');</script>";
   }
   else{
       //이미 취소된 요청일 시에
        echo "<script>alert('이미 취소된 요청입니다.');</script>";
   }
    echo "<script>location.replace('./mypage/request_view.php');</script>";
}
if(isset($_POST['request_all_cancle'])){
    $mb_id = trim($_POST['mb_id']);
    $o_state = "결제완료";
    $r_state = "요청취소완료";
    $case = 1;

    $sql = "SELECT o_state from orders where mb_id = '".$mb_id."'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)) {
        if(strpos($row['o_state'], "완료") !== false){
            //완료가 포함되어 있을 시에 == 이미 취소완료된 것인데 한번더 요청취소를 눌렀다
            $case=2;
        }
    }

    if($case == 1){
        $sql1="UPDATE orders set o_state = '$o_state' where mb_id ='$mb_id' and o_state like '%요청'";
        $result1 = mysqli_query($conn, $sql1);
        $sql2="UPDATE request set r_state = '$r_state' where mb_id ='$mb_id'";
        $result2 = mysqli_query($conn, $sql2);
        echo "<script>alert('변경되었습니다.');</script>";
    }
    else{
        echo "<script>alert('이미 취소된 요청이 있습니다.');</script>";
    }
    echo "<script>location.replace('./mypage/request_view.php');</script>";
}
?>