<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Lấy thông tin hóa đơn
$sale = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT *
FROM sales
WHERE id='$id'
"));

if(!$sale){
    echo "<script>alert('Không tìm thấy hóa đơn!');window.location='index.php';</script>";
    exit;
}

// Lấy chi tiết hóa đơn
$details = mysqli_query($conn,"
SELECT
sale_details.*,
products.product_name

FROM sale_details

LEFT JOIN products
ON sale_details.product_id = products.id

WHERE sale_details.sale_id='$id'
");
?>

<link rel="stylesheet" href="../../assets/css/dashboard.css">
<link rel="stylesheet" href="../../assets/css/products.css">

<div class="wrapper">

    <?php include("../../components/sidebar.php"); ?>

    <div class="main">

        <?php include("../../components/navbar.php"); ?>

        <div class="content">

            <div class="container">

                <div class="card">

                    <h1 style="text-align:center">
                        🧾 HÓA ĐƠN BÁN HÀNG
                    </h1>

                    <hr><br>

                    <table style="width:100%;border:none">

                        <tr>
                            <td><b>Mã hóa đơn:</b></td>
                            <td>#<?= $sale['id']; ?></td>
                        </tr>

                        <tr>
                            <td><b>Khách hàng:</b></td>
                            <td><?= $sale['customer_name']; ?></td>
                        </tr>

                        <tr>
                            <td><b>Ngày bán:</b></td>
                            <td><?= date("d/m/Y",strtotime($sale['sale_date'])); ?></td>
                        </tr>

                    </table>

                    <br>

                    <table>

                        <thead>

                        <tr>

                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php while($row=mysqli_fetch_assoc($details)){ ?>

                        <tr>

                            <td><?= $row['product_name']; ?></td>

                            <td><?= $row['quantity']; ?></td>

                            <td><?= number_format($row['price']); ?> VNĐ</td>

                            <td><?= number_format($row['subtotal']); ?> VNĐ</td>

                        </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                    <br>

                    <h2 style="text-align:right;color:#8B0000">

                        Tổng tiền:
                        <?= number_format($sale['total_price']); ?> VNĐ

                    </h2>

                    <br>

                    <div style="display:flex;gap:15px">

                        <button
                        onclick="window.print()"
                        class="btn-save">

                            🖨 In hóa đơn

                        </button>

                        <a
                        href="index.php"
                        class="btn-edit">

                            Quay lại

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>