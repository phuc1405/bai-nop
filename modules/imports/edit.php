<?php

include("../../includes/auth_admin.php");
include("../../config/database.php");
include("../../includes/header.php");

$id = (int)$_GET['id'];

$import = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM imports WHERE id=$id"
));

$products = mysqli_query($conn,"SELECT * FROM products");
$suppliers = mysqli_query($conn,"SELECT * FROM suppliers");

if(isset($_POST['update'])){

    $product = $_POST['product_id'];
    $supplier = $_POST['supplier_id'];
    $quantity = $_POST['quantity'];
    $date = $_POST['import_date'];

    mysqli_query($conn,"
        UPDATE imports SET
        product_id='$product',
        supplier_id='$supplier',
        quantity='$quantity',
        import_date='$date'
        WHERE id=$id
    ");

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

<h1>Sửa phiếu nhập</h1>

<p>Cập nhật thông tin phiếu nhập</p>

</div>

</div>

<div class="form-box">

<form method="POST">

<div class="form-group">

<label>Sản phẩm</label>

<select name="product_id" class="form-control">

<?php while($p=mysqli_fetch_assoc($products)){ ?>

<option
value="<?= $p['id'] ?>"
<?= $p['id']==$import['product_id']?'selected':'' ?>>

<?= $p['product_name'] ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Nhà cung cấp</label>

<select name="supplier_id" class="form-control">

<?php while($s=mysqli_fetch_assoc($suppliers)){ ?>

<option
value="<?= $s['id'] ?>"
<?= $s['id']==$import['supplier_id']?'selected':'' ?>>

<?= $s['supplier_name'] ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Số lượng</label>

<input
type="number"
name="quantity"
value="<?= $import['quantity'] ?>"
required>

</div>

<div class="form-group">

<label>Ngày nhập</label>

<input
type="date"
name="import_date"
value="<?= $import['import_date'] ?>"
required>

</div>

<button
class="btn-save"
name="update">

Cập nhật

</button>

<br><br>

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