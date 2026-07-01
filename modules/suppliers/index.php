<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

$result = mysqli_query(
    $conn,
    "SELECT * FROM suppliers ORDER BY id DESC"
);

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
                        <h1>Nhà cung cấp</h1>
                        <p>Quản lý danh sách nhà cung cấp</p>
                    </div>

                    <a href="create.php" class="btn-save">
                        + Thêm nhà cung cấp
                    </a>

                </div>

                <table>

                    <thead>

                    <tr>

                        <th>ID</th>
                        <th>Tên NCC</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php while($row=mysqli_fetch_assoc($result)){ ?>

                    <tr>

                        <td><?= $row['id'] ?></td>

                        <td><?= $row['supplier_name'] ?></td>

                        <td><?= $row['phone'] ?></td>

                        <td><?= $row['address'] ?></td>

                        <td>

                            <a
                            href="edit.php?id=<?= $row['id'] ?>"
                            class="btn-edit">
                            Sửa
                            </a>

                            <a
                            href="delete.php?id=<?= $row['id'] ?>"
                            class="btn-delete"
                            onclick="return confirm('Xóa nhà cung cấp này?')">
                            Xóa
                            </a>

                        </td>

                    </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>