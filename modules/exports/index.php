<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

// LẤY DỮ LIỆU XUẤT KHO
$result = mysqli_query($conn, "
    SELECT exports.*, customers.customer_name, products.product_name
    FROM exports
    LEFT JOIN customers ON exports.customer_id = customers.id
    LEFT JOIN products ON exports.product_id = products.id
    ORDER BY exports.id DESC
");
?>

<link rel="stylesheet" href="/Warehouse-App/assets/css/dashboard.css">
<link rel="stylesheet" href="/Warehouse-App/assets/css/products.css">

<div class="wrapper">

    <?php include("../../components/sidebar.php"); ?>

    <div class="main">

        <?php include("../../components/navbar.php"); ?>

        <div class="content">

            <div class="container">

                <div class="page-title">

                    <div>
                        <h1>Danh sách xuất kho</h1>
                        <p>Quản lý các phiếu xuất kho</p>
                    </div>

                    <a href="create.php" class="btn-add">
                        + Tạo phiếu xuất
                    </a>

                </div>

                <table>

                    <thead>

                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Ngày xuất</th>
                        <th>Thao tác</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php while($row=mysqli_fetch_assoc($result)){ ?>

                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['customer_name'] ?></td>
                        <td><?= $row['product_name'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= date("d/m/Y H:i", strtotime($row['created_at'])) ?></td>
                    </tr>
                    <td>

    <a
    href="edit.php?id=<?= $row['id'] ?>"
    class="btn-edit">

    Sửa

    </a>

    <a
    href="delete.php?id=<?= $row['id'] ?>"
    class="btn-delete"
    onclick="return confirm('Xóa phiếu xuất này?')">

    Xóa

    </a>

</td>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>