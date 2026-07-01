<?php

include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");

if(isset($_POST['save'])){

    $name = trim($_POST['customer_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    mysqli_query(
        $conn,
        "INSERT INTO customers
        (customer_name, phone, address)
        VALUES
        ('$name', '$phone', '$address')"
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
                        <h1>Thêm khách hàng</h1>
                        <p>Thêm khách hàng mới vào hệ thống</p>
                    </div>

                </div>

                <div class="form-box">

                    <form method="POST">

                        <div class="form-group">

                            <label>Tên khách hàng</label>

                            <input
                            type="text"
                            name="customer_name"
                            required>

                        </div>

                        <div class="form-group">

                            <label>Số điện thoại</label>

                            <input
                            type="text"
                            name="phone">

                        </div>

                        <div class="form-group">

                            <label>Địa chỉ</label>

                            <input
                            type="text"
                            name="address">

                        </div>

                        <button
                        class="btn-save"
                        name="save">

                        Lưu khách hàng

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