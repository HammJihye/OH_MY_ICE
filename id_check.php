<?php
include("./dbconn.php");
    if(isset($_GET['mb_email'])){
        $user_email = trim($_GET['mb_email']);
        $sql1 = "SELECT * from member where mb_email = '".$user_email."'";
        $result_Count1 = mysqli_query($conn,$sql1);
        $email_check = mysqli_num_rows($result_Count1);//전체 칼럼
    }
    else{
        if($_POST['userid'] != NULL){
            $user_id = trim($_POST['userid']);
            $sql = "SELECT * from member where mb_id = '".$user_id."'";
            $result_Count = mysqli_query($conn,$sql);
            $id_check = mysqli_num_rows($result_Count);//전체 칼럼
            
            if($id_check >= 1){
                echo "존재하는 아이디입니다.";
            } else {
                if(strpos($user_id, "admin") !== false){
                    //admin을 포함할 시에
                    echo "사용할 수 없는 아이디입니다.";
                }
                else{
                    echo "사용가능한 아이디입니다.";
                }
            }
    }
} ?>
<?php
    if(isset($_GET['mb_email'])){?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/basic.css?after">
    <title>Document</title>
</head>
<body>
    <?php
            if($email_check >=1){
                ?>
                <p class="text5" style="color:red;"><?php echo $user_email;?>은 이미 있는 이메일입니다.</p>
                <?php
            }
            else{
                ?>
                <p class="text5" style="color:green;"><?php echo $user_email;?>은 사용하실 수 있는 이메일입니다.</p>
                <?php
            }
    ?>
    <div class="close_btn_wrap">
    <button value="닫기" class="btn4" onclick="window.close()">닫기</button>
    </div>
</body>
</html>
<?php }?>