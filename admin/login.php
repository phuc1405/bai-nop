<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once(__DIR__ . "/../config/database.php");

$error = "";

/*
|---------------------------------------
| CHẶN NẾU ĐÃ LOGIN
|---------------------------------------
*/
if (!empty($_SESSION['admin']['id'])) {
    header("Location: dashboard.php");
    exit;
}

/*
|---------------------------------------
| XỬ LÝ LOGIN
|---------------------------------------
*/
if (isset($_POST['login'])) {

    if (!$conn) {
        die("Database connection failed!");
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password'
            LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        // reset session cũ
        session_unset();

        $_SESSION['admin'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'fullname' => $user['fullname'],
            'role' => $user['role']
        ];

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đăng nhập</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

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

.login{
width:430px;
background:#fff;
border-radius:20px;
padding:40px;
box-shadow:0 15px 35px rgba(0,0,0,.12);
}

.logo{
text-align:center;
margin-bottom:30px;
}

.logo img{
width:90px;
}

.logo h2{
margin-top:10px;
color:#8B0000;
}

.input{
margin-bottom:20px;
}

.input label{
display:block;
margin-bottom:8px;
font-weight:500;
}

.input input{
width:100%;
padding:13px;
border:1px solid #ddd;
border-radius:10px;
font-size:15px;
}

button{
width:100%;
padding:15px;
background:#8B0000;
color:#fff;
border:none;
border-radius:10px;
font-size:16px;
cursor:pointer;
}

button:hover{
background:#B22222;
}

.error{
background:#ffe5e5;
color:red;
padding:10px;
margin-bottom:20px;
border-radius:8px;
}

.footer{
margin-top:25px;
text-align:center;
font-size:13px;
color:#777;
}
</style>

</head>

<body>

<div class="login">

<div class="logo">
<img src="../assets/img/logo.png">
<h2>Tín Phát Warehouse</h2>
<p>Warehouse Management System</p>
</div>

<?php if($error != ""): ?>
<div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="POST">

<div class="input">
<label>Tài khoản</label>
<input type="text" name="username" required>
</div>

<div class="input">
<label>Mật khẩu</label>
<input type="password" name="password" required>
</div>

<div style="text-align:right;margin-bottom:15px;">
    <a href="forgot_password.php">
        Quên mật khẩu?
    </a>
</div>

<button name="login">
<i class="fa-solid fa-right-to-bracket"></i> Đăng nhập
</button>

</form>

<div class="footer">
TP-WMS © 2026
</div>

</div>

</body>
</html>