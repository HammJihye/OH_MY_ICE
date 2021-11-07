<?php

include("./dbconn.php");
include("PHPMailer/src/PHPMailer.php");
include("PHPMailer/src/SMTP.php");
$mb_id = trim($_POST['userid']);

if(strpos($mb_id, "admin")!==false){
    echo "<script>alert('관리자 아이디는 만들 수 없습니다. 다른 아이디를 만들어 주세요.');</script>";
    echo "<script>location.replace('./register.php');</script>";
}
else{
$mb_name = trim($_POST['mb_name']);
$mb_pwd = trim($_POST['mb_pwd']);
$mb_phone = trim($_POST['mb_phone']);
$mb_email = trim($_POST['email1'])."@".trim($_POST['email2']);;
$mb_gender = trim($_POST['gender']);
$mb_postcode = trim($_POST['mb_postcode']);
$mb_address = trim($_POST['mb_address'])." ".trim($_POST['mb_detailAddress']);

$sql = "SELECT * from member where mb_id = '".$mb_id."'";
$result_Count = mysqli_query($conn,$sql);
$id_check = mysqli_num_rows($result_Count);//전체 칼럼
$sql1 = "SELECT * from member where mb_email = '".$mb_email."'";
$result_Count1 = mysqli_query($conn,$sql1);
$email_check = mysqli_num_rows($result_Count1);//전체 칼럼

$sql2 = "SELECT max(mb_no) FROM member";
$result2 = mysqli_query($conn, $sql2);
$mb_row = mysqli_fetch_array($result2);
$mb_no=$mb_row[0]+1;

if($id_check >= 1 || $email_check >= 1){
    if($id_check >= 1){
        echo "<script>alert('아이디가 중복됩니다. 새로운 아이디를 입력해주세요.');</script>";
    }
    else{
        echo "<script>alert('이메일이 중복됩니다. 새로운 이메일을 입력해주세요.');</script>";
    }
    echo "<script>location.replace('./register.php');</script>";
}
else{
    $sql2 = "SELECT max(mb_no) FROM member";
    $result2 = mysqli_query($conn, $sql2);
    $mb_row = mysqli_fetch_array($result2);
    $mb_no=$mb_row[0]+1;

    $sql = " INSERT INTO member
                    SET mb_no = '$mb_no',
                    mb_id = '$mb_id',
                    mb_pwd = '$mb_pwd',
                    mb_name = '$mb_name',
                    mb_phone = '$mb_phone',
                    mb_email = '$mb_email',
                    mb_gender = '$mb_gender',
                    mb_address = '$mb_address'
                    ";
    $result = mysqli_query($conn, $sql);

    if(strlen($mb_email)>0){
        //이메일이 공백이 없을 때

        //Create a new PHPMailer instance
        $mail = new PHPMailer();

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        //SMTP::DEBUG_OFF = off (for production use)
        //SMTP::DEBUG_CLIENT = client messages
        //SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.naver.com';
        //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
        //if your network does not support SMTP over IPv6,
        //though this may cause issues with TLS

        //Set the SMTP port number:
        // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
        // - 587 for SMTP+STARTTLS
        $mail->Port = 465;

        //Set the encryption mechanism to use:
        // - SMTPS (implicit TLS on port 465) or
        // - STARTTLS (explicit TLS on port 587)
        $mail->SMTPSecure = 'ssl';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'wlgp4090dbfl';

        //Password to use for SMTP authentication
        $mail->Password = 'dbfl4090';

        $mail->CharSet = 'UTF-8';

        //Set who the message is to be sent from
        //Note that with gmail you can only use your account address (same as `Username`)
        //or predefined aliases that you have configured within your account.
        //Do not use user-submitted addresses in here
        $mail->setFrom('wlgp4090dbfl@naver.com', '함지혜');

        //Set an alternative reply-to address
        //This is a good place to put user-submitted addresses
        $mail->addReplyTo('wlgp4090dbfl@naver.com', '함지혜');

        //Set who the message is to be sent to
        $mail->addAddress($mb_email, $mb_name);//받을 사람
        //$mail->addAddress('gkawlgp0409@gmail.com', 'jihye');//나중에는 위에 것을 사용해야함

        //Set the subject line
        $mail->Subject = '- [OH MY ICE] 이메일인증 메일입니다!. -';//메일 제목

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //메일내용 html
        //$mail->msgHTML(file_get_contents('./contents.html'), __DIR__);

        //Replace the plain text body with one created manually
        $mb_md5 = md5(pack('V*', rand(), rand(),rand(),rand()));
        //$certify_herf = 'http://localhost/ohmyice/email_certify.php?mb_id='.$mb_id.'&mb_md5='.$mb_md5.'';
        $certify_herf = 'http://gkawlgp0409.cafe24.com/email_certify.php?mb_id='.$mb_id.'&mb_md5='.$mb_md5.'';
        $mail->Body = $certify_herf."\n위의 링크를 누르면 이메일 인증이 됩니다.";//메일 내용 부분

        //Attach an image file
        $mail->addAttachment('img/logo5.jpg');

        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //메일을 잘 보냈을 때
            $_SESSION['ss_uid'] = $mb_id;
            mysqli_close($conn);
            if(isset($_SESSION['ss_uid']))//세션이 있다면
            {
                echo "<script>location.replace('./email_certify_check.php');</script>";
            }
        }
    }
    else {
        echo "일단 테스트!";
    }
}
}
?>