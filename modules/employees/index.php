<?php

include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");

$result = mysqli_query(
    $conn,
    "SELECT * FROM users ORDER BY id DESC"
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
                        <h1>Quản lý nhân sự</h1>
                        <p>Quản lý tài khoản và phân quyền nhân viên</p>
                    </div>

                    <a href="create.php" class="btn-add">
                        + Thêm nhân viên
                    </a>

                </div>

                <table>

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Họ tên</th>
                            <th>Role</th>
                            <th>Thao tác</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php while($row = mysqli_fetch_assoc($result)){ ?>

                        <tr>

                            <td><?= $row['id'] ?></td>

                            <td><?= $row['username'] ?></td>

                            <td><?= $row['fullname'] ?></td>

                            <td><?= ucfirst($row['role']) ?></td>

                            <td>

                                <a
                                href="edit.php?id=<?= $row['id'] ?>"
                                class="btn-edit">
                                Sửa
                                </a>

                                <a
                                href="delete.php?id=<?= $row['id'] ?>"
                                class="btn-delete"
                                onclick="return confirm('Xóa nhân viên này?')">
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