<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css?after">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@200&family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8042524ed5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/dropdown.js"></script>
    <title>ADMIN_LOGIN</title>
  </head>
  <body style="background-color:#B2CCFF;">
    <div class="wrap" style="background-color:#B2CCFF;">
        <div class="main">
            <div class="login_form_wrap">
                <div class="section">
                    <i class="fas fa-cogs fa-3x" style="color : #6c5ce7;"></i>
                    <p class="titleText1" style="margin-top:15px; font-weight:bold;">관리자 페이지 로그인</p>
                </div>
                <form action="../login_check.php" method="post" class="loginForm" style="height:250px;">
                    <input type="hidden" name="login" value="admin">
                    <div class="idForm">
                    <input type="text" class="id" placeholder="ID" name ="mb_id">
                    </div>
                    <div class="passForm">
                    <input type="password" class="pw" placeholder="PW" name = "mb_pwd">
                    </div>
                    <input type="submit" class="btn" value="로그인">
                </form>
            </div>
        </div>
    </div>
  </body>
</html>