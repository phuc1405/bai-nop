<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");

$products = mysqli_query($conn, "SELECT * FROM products ORDER BY product_name");
$customers = mysqli_query($conn, "SELECT * FROM customers ORDER BY customer_name");

if(isset($_POST['save'])){

    $customer = $_POST['customer_name'];
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    $product = mysqli_fetch_assoc(
        mysqli_query($conn,"SELECT * FROM products WHERE id='$product_id'")
    );

    if(!$product){
        echo "<script>alert('Sản phẩm không tồn tại!');history.back();</script>";
        exit;
    }

    if($quantity <= 0){
        echo "<script>alert('Số lượng phải lớn hơn 0!');history.back();</script>";
        exit;
    }

    if($quantity > $product['quantity']){
        echo "<script>alert('Số lượng vượt quá tồn kho!');history.back();</script>";
        exit;
    }

    $price = $product['sale_price'];
    $subtotal = $price * $quantity;

    mysqli_query(
        $conn,
        "INSERT INTO sales(customer_name,total_price)
        VALUES('$customer','$subtotal')"
    );

    $sale_id = mysqli_insert_id($conn);

    mysqli_query(
        $conn,
        "INSERT INTO sale_details
        (sale_id,product_id,quantity,price,subtotal)
        VALUES
        ('$sale_id','$product_id','$quantity','$price','$subtotal')"
    );

    mysqli_query(
        $conn,
        "UPDATE products
        SET quantity = quantity - $quantity
        WHERE id='$product_id'"
    );

    header("Location:invoice.php?id=".$sale_id);
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
<h1>Tạo hóa đơn</h1>
<p>Bán hàng cho khách</p>
</div>

</div>

<div class="form-box">

<form method="POST">

<div class="form-group">

<label>Khách hàng</label>

<select
name="customer_name"
class="form-control"
required>

<?php while($c=mysqli_fetch_assoc($customers)){ ?>

<option value="<?= $c['customer_name']; ?>">

<?= $c['customer_name']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Sản phẩm</label>

<select
name="product_id"
class="form-control"
id="product">

<?php while($p=mysqli_fetch_assoc($products)){ ?>

<option
value="<?= $p['id']; ?>"
data-price="<?= $p['sale_price']; ?>"
data-stock="<?= $p['quantity']; ?>">

<?= $p['product_name']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Giá bán</label>

<input
type="text"
id="price"
class="form-control"
readonly>

</div>

<div class="form-group">

<label>Số lượng</label>

<input
type="number"
name="quantity"
id="quantity"
class="form-control"
value="1"
min="1"
required>

</div>

<div class="form-group">

<label>Tồn kho</label>

<input
type="text"
id="stock"
class="form-control"
readonly>

</div>

<div class="form-group">

<label>Thành tiền</label>

<input
type="text"
id="subtotal"
class="form-control"
readonly>

</div>

<button
class="btn-save"
name="save">

Thanh toán

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="../../assets/js/dashboard.js"></script>

<script>

const product=document.getElementById("product");
const qty=document.getElementById("quantity");
const price=document.getElementById("price");
const subtotal=document.getElementById("subtotal");
const stock=document.getElementById("stock");

function update(){

    const option=product.options[product.selectedIndex];

    const p=parseFloat(option.dataset.price)||0;
    const s=parseInt(option.dataset.stock)||0;
    const q=parseInt(qty.value)||0;

    price.value=p.toLocaleString('vi-VN')+" VNĐ";
    stock.value=s+" sản phẩm";
    subtotal.value=(p*q).toLocaleString('vi-VN')+" VNĐ";

}

product.addEventListener("change",update);
qty.addEventListener("input",update);

update();

</script>

<?php include("../../components/footer.php"); ?>