<?php
include("../../config/database.php");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=hoa_don.xls");

echo "ID\tKhách hàng\tTổng tiền\tNgày bán\n";

$result = mysqli_query(
    $conn,
    "SELECT * FROM sales ORDER BY id DESC"
);

while($row = mysqli_fetch_assoc($result)){

    echo $row['id'] . "\t";
    echo $row['customer_name'] . "\t";
    echo $row['total_price'] . "\t";
    echo $row['sale_date'] . "\n";
}
?>