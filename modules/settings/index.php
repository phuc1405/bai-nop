<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:../../admin/login.php");
    exit;
}

include("../../config/database.php");

$id = $_SESSION['admin']['id'];

if(isset($_POST['save'])){

    $password = md5($_POST['password']);

    mysqli_query(
        $conn,
        "UPDATE admins
         SET password='$password'
         WHERE id=$id"
    );

    echo "<script>alert('Đổi mật khẩu thành công');</script>";
}
?>

<link rel="stylesheet" href="../../assets/css/products.css">

<div class="container">

<div class="form-box">

<h1>Đổi mật khẩu</h1>

<form method="POST">

<input
type="password"
name="password"
placeholder="Mật khẩu mới"
required>

<br><br>

<button
name="save"
class="btn-save">

Lưu

</button>

</form>

</div>

</div>