<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/../config/database.php");

$msg = "";

if(!isset($_SESSION['reset_email'])){
    header("Location: forgot_password.php");
    exit;
}

if(isset($_POST['verify'])){

    $otp = trim($_POST['otp']);
    $email = $_SESSION['reset_email'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND otp='$otp'";

    $check = mysqli_query($conn,$sql);

    if(mysqli_num_rows($check) > 0){

        $_SESSION['otp_verified'] = true;

        header("Location: reset_password.php");
        exit;

    }else{

        $msg = "OTP không đúng!";

    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Xác thực OTP</title>

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

.msg{
text-align:center;
margin-top:15px;
color:red;
}
</style>
</head>

<body>

<div class="box">

<h2>Xác thực OTP</h2>

<form method="POST">

<input type="text"
       name="otp"
       placeholder="Nhập mã OTP"
       required>

<button name="verify">
Xác nhận OTP
</button>

</form>

<div class="msg">
<?= $msg ?>
</div>

</div>

</body>
</html>