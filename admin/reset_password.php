<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/../config/database.php");

if(
    !isset($_SESSION['otp_verified']) ||
    $_SESSION['otp_verified'] != true
){
    header("Location: forgot_password.php");
    exit;
}

if(isset($_POST['save'])){

    $password = trim($_POST['password']);
    $email = $_SESSION['reset_email'];

    mysqli_query($conn,
    "UPDATE users
     SET password='$password',
         otp=NULL,
         otp_expire=NULL
     WHERE email='$email'");

    session_unset();
    session_destroy();

    echo "
    <script>
    alert('Đổi mật khẩu thành công!');
    window.location='login.php';
    </script>
    ";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đặt lại mật khẩu</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

h2{
text-align:center;
color:#8B0000;
margin-bottom:25px;
}

input{
width:100%;
padding:13px;
border:1px solid #ddd;
border-radius:10px;
margin-bottom:20px;
}

button{
width:100%;
padding:15px;
background:#8B0000;
color:#fff;
border:none;
border-radius:10px;
cursor:pointer;
}

button:hover{
background:#B22222;
}
</style>
</head>

<body>

<div class="box">

<h2>Đặt lại mật khẩu</h2>

<form method="POST">

<input type="password"
       name="password"
       placeholder="Nhập mật khẩu mới"
       required>

<button name="save">
Đổi mật khẩu
</button>

</form>

</div>

</body>
</html>