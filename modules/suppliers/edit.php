<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM suppliers WHERE id='$id'"
);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = trim($_POST['supplier_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    mysqli_query(
        $conn,

        "UPDATE suppliers SET

        supplier_name='$name',

        phone='$phone',

        address='$address'

        WHERE id='$id'"
    );

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

<h1>Sửa nhà cung cấp</h1>

<p>Cập nhật thông tin nhà cung cấp</p>

</div>

</div>

<div class="form-box">

<form method="POST">

<div class="form-group">

<label>Tên nhà cung cấp</label>

<input
type="text"
name="supplier_name"
value="<?= htmlspecialchars($row['supplier_name']) ?>"
required>

</div>

<div class="form-group">

<label>Số điện thoại</label>

<input
type="text"
name="phone"
value="<?= htmlspecialchars($row['phone']) ?>">

</div>

<div class="form-group">

<label>Địa chỉ</label>

<input
type="text"
name="address"
value="<?= htmlspecialchars($row['address']) ?>">

</div>

<button
class="btn-save"
name="update">

Cập nhật

</button>

<a
href="index.php"
class="btn-delete">

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