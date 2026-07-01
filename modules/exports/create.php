<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

$customers = mysqli_query($conn,"SELECT * FROM customers");
$products = mysqli_query($conn,"SELECT * FROM products");

if(isset($_POST['save'])){

    $customer = $_POST['customer_id'];
    $product = $_POST['product_id'];
    $qty = $_POST['quantity'];

    mysqli_query($conn,"
        INSERT INTO exports(customer_id,product_id,quantity)
        VALUES('$customer','$product','$qty')
    ");

    mysqli_query($conn,"
        UPDATE products
        SET quantity = quantity - $qty
        WHERE id='$product'
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

<div class="form-box">

<h1>Tạo phiếu xuất kho</h1>

<form method="POST">

<div class="form-group">
<label>Khách hàng</label>

<select name="customer_id" class="form-control" required>

<?php while($c=mysqli_fetch_assoc($customers)){ ?>

<option value="<?= $c['id'] ?>">
<?= $c['customer_name'] ?>
</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Sản phẩm</label>

<select name="product_id" class="form-control" required>

<?php while($p=mysqli_fetch_assoc($products)){ ?>

<option value="<?= $p['id'] ?>">
<?= $p['product_name'] ?>
</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Số lượng</label>

<input
type="number"
name="quantity"
class="form-control"
required>

</div>

<button class="btn-save" name="save">
Lưu phiếu xuất
</button>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<?php include("../../components/footer.php"); ?>