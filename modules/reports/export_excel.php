<?php
session_start();
include("../../config/database.php");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=bao_cao_kho.xls");

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

<table border="1">
    <tr>
        <th colspan="3">BÁO CÁO KHO</th>
    </tr>

    <tr>
        <td>Tổng sản phẩm</td>
        <td colspan="2"><?= $totalProducts['total'] ?></td>
    </tr>

    <tr>
        <td>Tổng tồn kho</td>
        <td colspan="2"><?= $totalStock['total'] ?? 0 ?></td>
    </tr>

    <tr>
        <td>Tổng phiếu nhập</td>
        <td colspan="2"><?= $totalImports['total'] ?></td>
    </tr>

    <tr>
        <td>Tổng phiếu xuất</td>
        <td colspan="2"><?= $totalExports['total'] ?></td>
    </tr>

    <tr><td colspan="3"></td></tr>

    <tr>
        <th>Mã SP</th>
        <th>Tên SP</th>
        <th>Tồn kho</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($warning)){ ?>
    <tr>
        <td><?= $row['product_code'] ?></td>
        <td><?= $row['product_name'] ?></td>
        <td><?= $row['quantity'] ?></td>
    </tr>
    <?php } ?>
</table>