<?php

session_start();

include("../../config/database.php");

$products = mysqli_query(
    $conn,
    "SELECT * FROM products"
);

$suppliers = mysqli_query(
    $conn,
    "SELECT * FROM suppliers"
);

if(isset($_POST['save'])){

    $supplier_id = $_POST['supplier_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    mysqli_query(
        $conn,

        "INSERT INTO imports
        (supplier_id, product_id, quantity, import_date)
        VALUES
        ($supplier_id, $product_id, $quantity, NOW())"
    );

    mysqli_query(
        $conn,

        "UPDATE products

        SET quantity = quantity + $quantity

        WHERE id = $product_id"
    );

    header("Location:index.php");
    exit;
}

?>
<link rel="stylesheet" href="../../assets/css/products.css">

<div class="container">

<div class="form-box">

<h1>Phiếu nhập kho</h1>

<form method="POST">

<label>Nhà cung cấp</label>

<select name="supplier_id" required>

<?php while($s=mysqli_fetch_assoc($suppliers)){ ?>

<option value="<?= $s['id'] ?>">

<?= $s['supplier_name'] ?>

</option>

<?php } ?>

</select>

<br><br>

<label>Sản phẩm</label>

<select name="product_id" required>

<?php while($p=mysqli_fetch_assoc($products)){ ?>

<option value="<?= $p['id'] ?>">

<?= $p['product_name'] ?>

</option>

<?php } ?>

</select>

<br><br>

<label>Số lượng nhập</label>

<input
type="number"
name="quantity"
required>

<br><br>

<button
name="save"
class="btn-save">

Lưu phiếu nhập

</button>
    
</form>

</div>

</div>