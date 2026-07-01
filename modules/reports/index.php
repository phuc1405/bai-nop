<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

$totalProducts = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM products")
);

$totalStock = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT SUM(quantity) total FROM products")
);

$totalImports = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM imports")
);

$totalExports = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM exports")
);

$warning = mysqli_query(
    $conn,
    "SELECT * FROM products WHERE quantity < 10"
);
?>

<link rel="stylesheet" href="/Warehouse-App/assets/css/dashboard.css">
<link rel="stylesheet" href="/Warehouse-App/assets/css/products.css">

<style>
.stats{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin:25px 0;
}

.stat-card{
    background:#8B0000;
    color:#fff;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.stat-card h3{
    margin-bottom:10px;
    font-size:16px;
}

.stat-card h1{
    font-size:32px;
}

.report-box{
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.top-actions{
    margin:20px 0;
}

.btn{
    display:inline-block;
    background:#8B0000;
    color:#fff;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    margin-right:10px;
}

.btn:hover{
    background:#B22222;
}
</style>

<div class="wrapper">

    <?php include("../../components/sidebar.php"); ?>

    <div class="main">

        <?php include("../../components/navbar.php"); ?>

        <div class="content">

            <div class="container">

                <div class="page-title">

                    <div>
                        <h1>Báo cáo kho</h1>
                        <p>Thống kê tổng quan hệ thống</p>
                    </div>

                </div>

                <div class="top-actions">
                    <a href="../../admin/dashboard.php" class="btn">
                        ← Dashboard
                    </a>

                    <a href="export_excel.php" class="btn">
                        Xuất Excel
                    </a>

                    <a href="#" class="btn">
                        In PDF
                    </a>
                </div>

                <div class="stats">

                    <div class="stat-card">
                        <h3>Tổng sản phẩm</h3>
                        <h1><?= $totalProducts['total'] ?></h1>
                    </div>

                    <div class="stat-card">
                        <h3>Tổng tồn kho</h3>
                        <h1><?= $totalStock['total'] ?? 0 ?></h1>
                    </div>

                    <div class="stat-card">
                        <h3>Tổng phiếu nhập</h3>
                        <h1><?= $totalImports['total'] ?></h1>
                    </div>

                    <div class="stat-card">
                        <h3>Tổng phiếu xuất</h3>
                        <h1><?= $totalExports['total'] ?></h1>
                    </div>

                </div>

                <div class="report-box">

                    <h2>Sản phẩm sắp hết hàng</h2>

                    <br>

                    <table>

                        <thead>

                        <tr>
                            <th>Mã SP</th>
                            <th>Tên SP</th>
                            <th>Tồn kho</th>
                        </tr>

                        </thead>

                        <tbody>

                        <?php while($row = mysqli_fetch_assoc($warning)){ ?>

                        <tr>
                            <td><?= $row['product_code'] ?></td>
                            <td><?= $row['product_name'] ?></td>
                            <td><?= $row['quantity'] ?></td>
                        </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>