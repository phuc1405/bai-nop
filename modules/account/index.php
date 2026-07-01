<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:../../admin/login.php");
    exit;
}

include("../../config/database.php");

$id = $_SESSION['admin']['id'];

$admin = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM admins WHERE id=$id")
);
?>

<link rel="stylesheet" href="../../assets/css/products.css">

<div class="container">

<div class="form-box">

<h1>Tài khoản</h1>

<p><b>Họ tên:</b> <?= $admin['fullname']; ?></p>

<p><b>Email:</b> <?= $admin['email']; ?></p>

<p><b>Tên đăng nhập:</b> <?= $admin['username']; ?></p>

</div>

</div>