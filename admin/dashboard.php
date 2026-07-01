<?php
include("../includes/auth_admin.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit;

}

include("../includes/header.php");

include("../config/database.php");

$total_products = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM products"
    )
);

$total_imports = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM imports"
    )
);

$total_exports = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM exports"
    )
);

$low_stock = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total
         FROM products
         WHERE quantity < 10"
    )
);



// ===== IMPORT 7 NGÀY =====
$importData = array_fill(0, 7, 0);

$sql = mysqli_query($conn,"
SELECT DATE(import_date) as day, SUM(quantity) as total
FROM imports
WHERE import_date >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
GROUP BY DATE(import_date)
");

$temp = [];
while($row = mysqli_fetch_assoc($sql)){
    $temp[$row['day']] = (int)$row['total'];
}

for($i=6; $i>=0; $i--){
    $d = date('Y-m-d', strtotime("-$i days"));
    $importData[6-$i] = $temp[$d] ?? 0;
}

// ===== EXPORT 7 NGÀY =====
$exportData = array_fill(0, 7, 0);

$sql = mysqli_query($conn,"
SELECT DATE(created_at) as day, SUM(quantity) as total
FROM exports
WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
GROUP BY DATE(created_at)
");

$temp = [];
while($row = mysqli_fetch_assoc($sql)){
    $temp[$row['day']] = (int)$row['total'];
}

for($i=6; $i>=0; $i--){
    $d = date('Y-m-d', strtotime("-$i days"));
    $exportData[6-$i] = $temp[$d] ?? 0;
}

$labels = [];
for($i=6; $i>=0; $i--){
    $labels[] = date('d/m', strtotime("-$i days"));
}

?>

<link rel="stylesheet" href="../assets/css/dashboard.css">

<div class="wrapper">

    <?php include("../components/sidebar.php"); ?>

    <div class="main">

        <?php include("../components/navbar.php"); ?>

        <div class="content">

            <div class="page-title">

                <div>

                    <h1>Dashboard</h1>

                    <p>Xin chào,
                        <strong><?php echo $_SESSION['admin']['fullname']; ?></strong>
                    </p>

                </div>

                <div class="today">

                    <?php echo date("d/m/Y"); ?>

                </div>

            </div>

            <div class="cards">

                <div class="card">

                    <div>

                        <span>Tổng sản phẩm</span>

                       <h2><?= $total_products['total']; ?></h2>

                    </div>

                    <i class="fa-solid fa-box"></i>

                </div>

                <div class="card">

                    <div>

                        <span>Đơn nhập</span>

                        <h2><?= $total_imports['total']; ?></h2>

                    </div>

                    <i class="fa-solid fa-download"></i>

                </div>

                <div class="card">

                    <div>

                        <span>Đơn xuất</span>

                        <h2><?= $total_exports['total']; ?></h2>

                    </div>

                    <i class="fa-solid fa-upload"></i>

                </div>

                <div class="card">

                    <div>

                        <span>Sắp hết hàng</span>

                        <h2><?= $low_stock['total']; ?></h2>

                    </div>

                    <i class="fa-solid fa-triangle-exclamation"></i>

                </div>

            </div>

            <div class="dashboard-row">

                <div class="chart">

                    <h3>Thống kê nhập / xuất</h3>

                    <canvas id="warehouseChart"></canvas>

                </div> 

                <div class="activity">

                    <h3>Hoạt động gần đây</h3>

                    <ul>

                       <?php

$recent_imports = mysqli_query(
    $conn,

    "SELECT
        imports.quantity,
        products.product_name

     FROM imports

     LEFT JOIN products
     ON imports.product_id = products.id

     ORDER BY imports.id DESC

     LIMIT 5"
);

while($row = mysqli_fetch_assoc($recent_imports)){

?>

<li>

✔ Nhập

<?= $row['quantity']; ?>

SP

<?= $row['product_name']; ?>

</li>

<?php } ?>

                        <li>✔ Cập nhật thông tin nhà cung cấp.</li>

                        <li>✔ Sao lưu dữ liệu thành công.</li>

                    </ul>

                </div>

            </div>
            <div class="table-section">

<div class="table-box">

<div class="table-header">
<h3>Phiếu nhập gần đây</h3>
<a href="../modules/imports/index.php" class="view-all">Xem tất cả</a>
</div>

<table>

<thead>

<tr>
<th>Mã</th>
<th>Nhà CC</th>
<th>SL</th>
<th>Trạng thái</th>
</tr>

</thead>

<tbody>

<?php

$recentImports = mysqli_query(
    $conn,
    "SELECT imports.*, suppliers.supplier_name
     FROM imports
     LEFT JOIN suppliers
     ON imports.supplier_id = suppliers.id
     ORDER BY imports.id DESC
     LIMIT 5"
);

while($row = mysqli_fetch_assoc($recentImports)){
?>

<tr>
    <td>PN<?= str_pad($row['id'], 3, '0', STR_PAD_LEFT) ?></td>
    <td><?= $row['supplier_name'] ?></td>
    <td><?= $row['quantity'] ?></td>
    <td><span class="badge success">Hoàn thành</span></td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

<div class="table-box">

<div class="table-header">
<h3>Phiếu xuất gần đây</h3>
<a href="../modules/exports/index.php" class="view-all">Xem tất cả</a>
</div>

<table>

<thead>

<tr>
<th>Mã</th>
<th>Khách hàng</th>
<th>SL</th>
<th>Trạng thái</th>
</tr>

</thead>

<tbody>

<?php

$recentExports = mysqli_query(
    $conn,
    "SELECT exports.*, customers.customer_name
     FROM exports
     LEFT JOIN customers
     ON exports.customer_id = customers.id
     ORDER BY exports.id DESC
     LIMIT 5"
);

while($row = mysqli_fetch_assoc($recentExports)){

?>

<tr>
    <td>PX<?= str_pad($row['id'], 3, '0', STR_PAD_LEFT) ?></td>
    <td><?= $row['customer_name']; ?></td>
    <td><?= $row['quantity']; ?></td>
    <td><span class="badge primary">Đã xuất</span></td>
</tr>

<?php } ?>

</tbody>

</table>

</div>
<div class="table-section">

<div class="table-box">

<h3>Sản phẩm sắp hết hàng</h3>

<table>

<tr>

<th>Mã</th>
<th>Tên</th>
<th>Tồn kho</th>

</tr>

<?php

$warning = mysqli_query(

$conn,

"SELECT *

 FROM products

 WHERE quantity < 10"

);

while($row=mysqli_fetch_assoc($warning)){

?>

<tr>

<td><?= $row['product_code']; ?></td>

<td><?= $row['product_name']; ?></td>

<td><?= $row['quantity']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

        </div>

    </div>

</div>


</div>

</div>

<script>
window.importData = <?= json_encode($importData); ?>;
window.exportData = <?= json_encode($exportData); ?>;
window.chartLabels = <?= json_encode($labels); ?>;
</script>

<script>
console.log("Import:", <?= json_encode($importData); ?>);
console.log("Export:", <?= json_encode($exportData); ?>);
console.log("Labels:", <?= json_encode($labels); ?>);
</script>

<script src="../assets/js/dashboard.js"></script>

<?php include("../components/footer.php"); ?>
