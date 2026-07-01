<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM exports WHERE id='$id'
"));

$customers = mysqli_query($conn,"SELECT * FROM customers");
$products = mysqli_query($conn,"SELECT * FROM products");

if(isset($_POST['update'])){

    $customer = $_POST['customer'];
    $product = $_POST['product'];
    $qty = $_POST['quantity'];

    mysqli_query($conn,"
    UPDATE exports SET

    customer_id='$customer',
    product_id='$product',
    quantity='$qty'

    WHERE id='$id'
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

<h1>Sửa phiếu xuất</h1>

<form method="POST">

<label>Khách hàng</label>

<select name="customer" class="form-control">

<?php while($c=mysqli_fetch_assoc($customers)){ ?>

<option
value="<?= $c['id'] ?>"
<?= $c['id']==$data['customer_id']?'selected':'' ?>>

<?= $c['customer_name'] ?>

</option>

<?php } ?>

</select>

<label>Sản phẩm</label>

<select name="product" class="form-control">

<?php while($p=mysqli_fetch_assoc($products)){ ?>

<option
value="<?= $p['id'] ?>"
<?= $p['id']==$data['product_id']?'selected':'' ?>>

<?= $p['product_name'] ?>

</option>

<?php } ?>

</select>

<label>Số lượng</label>

<input
type="number"
name="quantity"
class="form-control"
value="<?= $data['quantity'] ?>"
required>

<button
name="update"
class="btn-save">

Cập nhật

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<?php include("../../components/footer.php"); ?>