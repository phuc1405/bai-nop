<?php

session_start();

include("../../config/database.php");

include("../../includes/header.php");


if(isset($_POST['save'])){

    $name = $_POST['supplier_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    mysqli_query(
        $conn,

        "INSERT INTO suppliers
        (supplier_name,phone,address)

        VALUES
        ('$name','$phone','$address')"
    );

    header("Location:index.php");
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

<div class="form-box">

<h1>Thêm nhà cung cấp</h1>

<form method="POST">

<input
type="text"
name="supplier_name"
placeholder="Tên NCC"
required>

<br><br>

<input
type="text"
name="phone"
placeholder="Số điện thoại">

<br><br>

<input
type="text"
name="address"
placeholder="Địa chỉ">

<br><br>

<button
name="save"
class="btn-save">

Lưu

</button>

</form>

            </div>

        </div>

    </div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>

</form>

</div> <!-- form-box -->

</div> <!-- container -->

</div> <!-- content -->

</div> <!-- main -->

</div> <!-- wrapper -->

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>