<?php

session_start();

include("../../includes/auth_admin.php");
include("../../config/database.php");

require("../../admin/send_account.php");
require("../../admin/send_otp.php");

include("../../includes/header.php");

if(isset($_POST['save'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Email không đúng định dạng!");
    }

    $checkUser = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE username='$username'"
    );

    if(mysqli_num_rows($checkUser) > 0){
        die("Tên đăng nhập đã tồn tại!");
    }

    $checkEmail = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($checkEmail) > 0){
        die("Email đã tồn tại!");
    }

    $otp = rand(100000,999999);

$_SESSION['new_employee'] = [
    'username' => $username,
    'password' => $password,
    'fullname' => $fullname,
    'email'    => $email,
    'role'     => $role,
    'otp'      => $otp
];

if(sendOTP($email,$otp)){

    header("Location: verify_employee_otp.php");
    exit;

}else{

    die("Không gửi được OTP!");

}
}
?>

<link rel="stylesheet" href="../../assets/css/dashboard.css">
<link rel="stylesheet" href="../../assets/css/products.css">

<div class="wrapper">

<?php include("../../components/sidebar.php"); ?>

<div class="main">

<?php include("../../components/navbar.php"); ?>

<div class="content">

<div class="container">

<div class="page-title">

<div>

<h1>Thêm nhân viên</h1>

<p>Tạo tài khoản nhân viên mới</p>

</div>

</div>

<div class="form-box">

<form method="POST">

<div class="form-group">
<label>Tài khoản</label>
<input type="text" name="username" required>
</div>

<div class="form-group">
<label>Mật khẩu</label>
<input type="password" name="password" required>
</div>

<div class="form-group">
<label>Họ tên</label>
<input type="text" name="fullname" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" required>
</div>

<div class="form-group">
<label>Phân quyền</label>

<select name="role" class="form-control">

<option value="admin">Admin</option>

<option value="employee">Employee</option>

</select>

</div>

<button class="btn-save" name="save">
Lưu
</button>

<a href="index.php" class="btn-delete">
Quay lại
</a>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>