<?php
include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");

$result=mysqli_query($conn,"SELECT * FROM contracts ORDER BY id DESC");
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

<h1>Quản lý hợp đồng</h1>

<p>Danh sách hợp đồng</p>

</div>

<a href="create.php" class="btn-add">

+ Thêm hợp đồng

</a>

</div>

<table>

<thead>

<tr>

<th>ID</th>
<th>Mã hợp đồng</th>
<th>Đối tác</th>
<th>Ngày bắt đầu</th>
<th>Ngày kết thúc</th>
<th>Trạng thái</th>
<th>File</th>
<th>Thao tác</th>

</tr>

</thead>

<tbody>

<?php if(mysqli_num_rows($result)>0){ ?>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?= $row['id'] ?></td>

<td><?= $row['contract_code'] ?></td>

<td><?= $row['partner_name'] ?></td>

<td><?= date("d/m/Y",strtotime($row['start_date'])) ?></td>

<td><?= date("d/m/Y",strtotime($row['end_date'])) ?></td>

<td><?= $row['status'] ?></td>

<td>

<?php if($row['file']!=""){ ?>

<a href="../../assets/contracts/<?= $row['file'] ?>" target="_blank">

Xem

</a>

<?php } ?>

</td>

<td>

<a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">

Sửa

</a>

<a href="delete.php?id=<?= $row['id'] ?>"

class="btn-delete"

onclick="return confirm('Xóa hợp đồng?')">

Xóa

</a>

</td>

</tr>

<?php } ?>

<?php }else{ ?>

<tr>

<td colspan="8" style="text-align:center;padding:30px">

Chưa có hợp đồng.

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