<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../admin/login.php");
    exit;
}

if($_SESSION['admin']['role'] != 'admin'){
    die("Bạn không có quyền truy cập!");
}

include("../../includes/header.php");
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
                        <h1>Backup / Restore</h1>
                        <p>Sao lưu và khôi phục cơ sở dữ liệu hệ thống</p>
                    </div>

                </div>

                <div class="cards">

                    <!-- Backup -->

                    <div class="card">

                        <i class="fa-solid fa-database fa-3x"></i>

                        <h3>Sao lưu Database</h3>

                        <p>
                            Tạo file sao lưu toàn bộ dữ liệu của hệ thống.
                        </p>

                        <a href="backup.php" class="btn-save">
                            Backup ngay
                        </a>

                    </div>

                    <!-- Restore -->

                    <div class="card">

                        <i class="fa-solid fa-upload fa-3x"></i>

                        <h3>Khôi phục Database</h3>

                        <p>
                            Chọn file <strong>.sql</strong> để khôi phục dữ liệu.
                        </p>

                        <form
                            action="restore.php"
                            method="POST"
                            enctype="multipart/form-data">

                            <input
                                type="file"
                                name="sql_file"
                                class="form-control"
                                accept=".sql"
                                required>

                            <br>

                            <button
                                type="submit"
                                class="btn-save">

                                Restore Database

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>