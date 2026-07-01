<?php

include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");
$result = mysqli_query(
    $conn,
    "SELECT * FROM customers ORDER BY id DESC"
);

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
                        <h1>Khách hàng</h1>
                        <p>Quản lý danh sách khách hàng</p>
                    </div>

                    <a href="create.php" class="btn-add">
                        + Thêm khách hàng
                    </a>

                </div>

                <table>

                    <thead>

                    <tr>

                        <th>ID</th>
                        <th>Tên KH</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>

                    </tr>

                    </thead>

                    <tbody>

<?php if(mysqli_num_rows($result)>0){ ?>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['customer_name']) ?></td>
    <td><?= htmlspecialchars($row['phone']) ?></td>
    <td><?= htmlspecialchars($row['address']) ?></td>

    <td>

        <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">
            Sửa
        </a>

        <a href="delete.php?id=<?= $row['id'] ?>"
           class="btn-delete"
           onclick="return confirm('Xóa khách hàng này?')">
            Xóa
        </a>

    </td>

</tr>

<?php } ?>

<?php }else{ ?>

<tr>

<td colspan="5" style="text-align:center;padding:30px">

Chưa có khách hàng.

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