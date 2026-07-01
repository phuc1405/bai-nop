<?php
include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM contracts WHERE id='$id'");

$row=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$code=$_POST['contract_code'];

$partner=$_POST['partner_name'];

$start=$_POST['start_date'];

$end=$_POST['end_date'];

$status=$_POST['status'];

$file=$row['file'];

if($_FILES['file']['name']!=""){

$file=time()."_".$_FILES['file']['name'];

move_uploaded_file(

$_FILES['file']['tmp_name'],

"../../assets/contracts/".$file

);

}

mysqli_query($conn,"UPDATE contracts SET

contract_code='$code',

partner_name='$partner',

start_date='$start',

end_date='$end',

status='$status',

file='$file'

WHERE id='$id'");

header("Location:index.php");

exit;

}
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

<h1>Sửa hợp đồng</h1>

<p>Cập nhật thông tin hợp đồng</p>

</div>

</div>

<div class="form-box">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">

<label>Mã hợp đồng</label>

<input
type="text"
name="contract_code"
class="form-control"
value="<?= $row['contract_code'] ?>"
required>

</div>

<div class="form-group">

<label>Đối tác</label>

<input
type="text"
name="partner_name"
class="form-control"
value="<?= $row['partner_name'] ?>"
required>

</div>

<div class="form-group">

<label>Ngày bắt đầu</label>

<input
type="date"
name="start_date"
class="form-control"
value="<?= $row['start_date'] ?>"
required>

</div>

<div class="form-group">

<label>Ngày kết thúc</label>

<input
type="date"
name="end_date"
class="form-control"
value="<?= $row['end_date'] ?>"
required>

</div>

<div class="form-group">

<label>Trạng thái</label>

<select
name="status"
class="form-control">

<option <?= $row['status']=="Đang hiệu lực"?"selected":"" ?>>

Đang hiệu lực

</option>

<option <?= $row['status']=="Hết hạn"?"selected":"" ?>>

Hết hạn

</option>

<option <?= $row['status']=="Tạm dừng"?"selected":"" ?>>

Tạm dừng

</option>

</select>

</div>

<div class="form-group">

<label>Đổi file hợp đồng</label>

<input
type="file"
name="file"
class="form-control">

</div>

<button
name="update"
class="btn-save">

Cập nhật

</button>

<a
href="index.php"
class="btn-delete">

Quay lại

</a>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>