<?php

session_start();

include("../../config/database.php");

$id = $_GET['id'];

$product = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM products WHERE id=$id"
    )
);

if(isset($_POST['update'])){

    $code = $_POST['product_code'];
    $name = $_POST['product_name'];
    $qty  = $_POST['quantity'];

    $import = $_POST['import_price'];
    $sale = $_POST['sale_price'];

    mysqli_query(
        $conn,

        "UPDATE products SET

        product_code='$code',
        product_name='$name',
        quantity='$qty',
        import_price='$import',
        sale_price='$sale'

        WHERE id=$id"
    );

    header("Location:index.php");
}

?>
<link rel="stylesheet" href="../../assets/css/products.css">

<div class="container">

    <div class="form-box">

        <h1>Sửa sản phẩm</h1>

        <form method="POST">

            <input
            type="text"
            name="product_code"
            value="<?= $product['product_code']; ?>"
            required>

            <br><br>

            <input
            type="text"
            name="product_name"
            value="<?= $product['product_name']; ?>"
            required>

            <br><br>

            <input
            type="number"
            name="quantity"
            value="<?= $product['quantity']; ?>"
            required>

            <br><br>

            <input
            type="number"
            name="import_price"
            value="<?= $product['import_price']; ?>"
            required>

            <br><br>

            <input
            type="number"
            name="sale_price"
            value="<?= $product['sale_price']; ?>"
            required>

            <br><br>

            <button type="submit" name="update">
                Cập nhật
            </button>

        </form>

    </div>

</div>