<?php

include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");

if(isset($_POST['save'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $fullname = trim($_POST['fullname']);
    $role = $_POST['role'];

    mysqli_query($conn,"
        INSERT INTO users(username,password,fullname,role)
        VALUES('$username','$password','$fullname','$role')
    ");

    header("Location: index.php");
    exit;
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