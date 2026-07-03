<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/../config/database.php");
require 'send_otp.php';

$msg = "";

if(isset($_POST['send'])){

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $check = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE username='$username'
         AND email='$email'"
    );

    if(mysqli_num_rows($check) == 0){

        $msg = "Tên tài khoản hoặc Email không đúng!";

    }else{

        $otp = rand(100000,999999);

        $expire = date(
            "Y-m-d H:i:s",
            strtotime("+5 minutes")
        );

        mysqli_query(
            $conn,
            "UPDATE users
             SET otp='$otp',
                 otp_expire='$expire'
             WHERE username='$username'
             AND email='$email'"
        );

        if(sendOTP($email,$otp)){

            $_SESSION['reset_email'] = $email;

            header("Location: verify_otp.php");
            exit;

        }else{

            $msg = "Gửi OTP thất bại!";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Quên mật khẩu</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins,sans-serif;
}

body{
background:#eceff4;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
width:430px;
background:#fff;
border-radius:20px;
padding:40px;
box-shadow:0 15px 35px rgba(0,0,0,.12);
}

.logo{
text-align:center;
margin-bottom:25px;
}

.logo img{
width:90px;
}

.logo h2{
margin-top:10px;
color:#8B0000;
}

.logo p{
margin-top:8px;
color:#666;
font-size:14px;
}

input{
width:100%;
padding:13px;
border:1px solid #ddd;
border-radius:10px;
margin-bottom:20px;
font-size:14px;
}

input:focus{
outline:none;
border-color:#8B0000;
}

button{
width:100%;
padding:15px;
background:#8B0000;
color:#fff;
border:none;
border-radius:10px;
cursor:pointer;
font-size:15px;
font-weight:600;
}

button:hover{
background:#B22222;
}

.msg{
margin-top:15px;
text-align:center;
color:red;
font-size:14px;
}

</style>

</head>

<body>

<div class="box">

<div class="logo">

<img src="../assets/img/logo.png">

<h2>Quên mật khẩu</h2>

<p>Nhập tài khoản và Email để nhận mã OTP</p>

</div>

<form method="POST">

<input
type="text"
name="username"
placeholder="Nhập tên tài khoản"
required>

<input
type="email"
name="email"
placeholder="Nhập Email đã đăng ký"
required>

<button name="send">
Gửi OTP
</button>

</form>

<div class="msg">
<?= $msg ?>
</div>

</div>

</body>

</html>