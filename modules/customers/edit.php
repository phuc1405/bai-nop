<?php

include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM customers WHERE id=$id"
);

$row = mysqli_fetch_assoc($result);

if(!$row){
    header("Location: index.php");
    exit;
}

if(isset($_POST['update'])){

    $name = trim($_POST['customer_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    mysqli_query(
        $conn,
        "UPDATE customers SET
        customer_name='$name',
        phone='$phone',
        address='$address'
        WHERE id=$id"
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

<h1>Sửa khách hàng</h1>

<p>Cập nhật thông tin khách hàng</p>

</div>

</div>

<div class="form-box">

<form method="POST">

<div class="form-group">

<label>Tên khách hàng</label>

<input
type="text"
name="customer_name"
value="<?= htmlspecialchars($row['customer_name']) ?>"
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

<br><br>

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