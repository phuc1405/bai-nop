<?php

session_start();

if (!isset($_SESSION['admin'])) {

header("Location: ../../admin/login.php");

exit;

}

include("../../config/database.php");

include("../../includes/header.php");

if (isset($_POST['save'])) {

$code = $_POST['product_code'];

$name = $_POST['product_name'];

$quantity = $_POST['quantity'];

$import_price = $_POST['import_price'];

$sale_price = $_POST['sale_price'];

$image = "";

// Upload ảnh

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

    $ext = pathinfo(
        $_FILES['image']['name'],
        PATHINFO_EXTENSION
    );

    $image = time() . "." . $ext;

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../../assets/uploads/" . $image
    );
}

$sql = "INSERT INTO products

(product_code,product_name,quantity,import_price,sale_price,image)

VALUES

('$code','$name','$quantity','$import_price','$sale_price','$image')";

mysqli_query($conn, $sql);

header("Location: index.php");

exit;

}

?>

<link rel="stylesheet" href="../../assets/css/products.css">

<div class="container">

<div class="form-box">

<h1>Thêm sản phẩm</h1>

<form method="POST" enctype="multipart/form-data">

<div class="form-group">

<label>Mã sản phẩm</label>

<input type="text" name="product_code" required>

</div>

<div class="form-group">

<label>Tên sản phẩm</label>

<input type="text" name="product_name" required>

</div>

<div class="form-group">

<label>Số lượng</label>

<input type="number" name="quantity" required>

</div>

<div class="form-group">

<label>Giá nhập</label>

<input type="number" name="import_price" required>

</div>

<div class="form-group">

<label>Giá bán</label>

<input type="number" name="sale_price" required>

</div>

<div class="form-group">

<label>Ảnh sản phẩm</label>

<input type="file" name="image">

</div>

<button type="submit" name="save" class="btn-save">

Lưu sản phẩm

</button>

</form>

</div>

</div>

<?php include("../../components/footer.php"); ?>