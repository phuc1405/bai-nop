<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

$result = mysqli_query($conn,"
SELECT *
FROM sales
ORDER BY id DESC
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

                <div class="page-title">

                    <div>
                        <h1>Bán hàng</h1>
                        <p>Quản lý hóa đơn bán hàng</p>
                    </div>

                    <a href="create.php" class="btn-add">
                        + Tạo hóa đơn
                    </a>

                </div>

                <table>

                    <thead>

                    <tr>

                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày bán</th>
                        <th>Thao tác</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php if(mysqli_num_rows($result)>0){ ?>

                        <?php while($row=mysqli_fetch_assoc($result)){ ?>

                        <tr>

                            <td><?= $row['id'] ?></td>

                            <td><?= $row['customer_name'] ?></td>

                            <td><?= number_format($row['total_price']) ?> VNĐ</td>

                            <td><?= date("d/m/Y",strtotime($row['sale_date'])) ?></td>

                            <td>

    <a
    href="invoice.php?id=<?= $row['id'] ?>"
    class="btn-edit">

        Xem hóa đơn

    </a>

</td>
                            

                        </tr>

                        <?php } ?>

                    <?php }else{ ?>

                        <tr>

                            <td colspan="5" style="text-align:center;padding:30px">

                                Chưa có hóa đơn.

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