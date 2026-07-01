<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

// LẤY DỮ LIỆU NHẬP KHO
$result = mysqli_query($conn, "
    SELECT imports.*, suppliers.supplier_name, products.product_name
    FROM imports
    LEFT JOIN suppliers ON imports.supplier_id = suppliers.id
    LEFT JOIN products ON imports.product_id = products.id
    ORDER BY imports.id DESC
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
                        <h1>Danh sách nhập kho</h1>
                        <p>Quản lý các phiếu nhập kho</p>
                    </div>

                    <a href="create.php" class="btn-add">
                        + Tạo phiếu nhập
                    </a>

                </div>

                <table>

                    <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nhà cung cấp</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Ngày nhập</th>
                        <th>Thao tác</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php while($row=mysqli_fetch_assoc($result)){ ?>

                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['supplier_name'] ?></td>
                        <td><?= $row['product_name'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= date("d/m/Y", strtotime($row['import_date'])) ?></td>
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
    onclick="return confirm('Xóa phiếu nhập này?')">

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