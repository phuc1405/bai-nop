<?php

include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");

$id=(int)$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM users WHERE id=$id");

$row=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$username=$_POST['username'];
$password=$_POST['password'];
$fullname=$_POST['fullname'];
$role=$_POST['role'];

mysqli_query($conn,"
UPDATE users SET
username='$username',
password='$password',
fullname='$fullname',
role='$role'
WHERE id=$id
");

header("Location:index.php");
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

<h1>Sửa nhân viên</h1>

<p>Cập nhật thông tin nhân viên</p>

</div>

</div>

<div class="form-box">

<form method="POST">

<div class="form-group">
<label>Tài khoản</label>
<input type="text" name="username" value="<?= $row['username'] ?>">
</div>

<div class="form-group">
<label>Mật khẩu</label>
<input type="text" name="password" value="<?= $row['password'] ?>">
</div>

<div class="form-group">
<label>Họ tên</label>
<input type="text" name="fullname" value="<?= $row['fullname'] ?>">
</div>

<div class="form-group">

<label>Role</label>

<select name="role" class="form-control">

<option value="admin" <?= $row['role']=="admin"?"selected":"" ?>>Admin</option>

<option value="employee" <?= $row['role']=="employee"?"selected":"" ?>>Employee</option>

</select>

</div>

<button class="btn-save" name="update">

Cập nhật

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