<?php
include("../../includes/auth_admin.php");

include("../../config/database.php");

$result = mysqli_query(
    $conn,
    "SELECT *
     FROM contracts
     WHERE end_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
     ORDER BY end_date ASC"
);
?>

<link rel="stylesheet" href="../../assets/css/products.css">

<div class="container">

    <h1>Hợp đồng sắp hết hạn (30 ngày)</h1>

    <table>
        <tr>
            <th>Mã HĐ</th>
            <th>Đối tác</th>
            <th>Ngày hết hạn</th>
            <th>Trạng thái</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?= $row['contract_code'] ?></td>
            <td><?= $row['partner_name'] ?></td>
            <td><?= $row['end_date'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php } ?>

    </table>

</div>