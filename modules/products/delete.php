<?php

include("../../config/database.php");

$id = (int)$_GET['id'];

// Lấy thông tin sản phẩm
$product = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM products WHERE id = $id")
);

// Kiểm tra sản phẩm có trong phiếu nhập không
$checkImport = mysqli_query(
    $conn,
    "SELECT id FROM imports WHERE product_id = $id LIMIT 1"
);

// Kiểm tra sản phẩm có trong phiếu xuất không
$checkExport = mysqli_query(
    $conn,
    "SELECT id FROM exports WHERE product_id = $id LIMIT 1"
);

if(mysqli_num_rows($checkImport) > 0 || mysqli_num_rows($checkExport) > 0){

    echo "<script>
        alert('Không thể xóa! Sản phẩm đã phát sinh phiếu nhập hoặc phiếu xuất.');
        window.location='index.php';
    </script>";

    exit;
}

// Xóa ảnh nếu tồn tại
if(!empty($product['image'])){

    $file = "../../assets/uploads/" . $product['image'];

    if(file_exists($file) && is_file($file)){
        unlink($file);
    }

}

// Xóa sản phẩm
mysqli_query(
    $conn,
    "DELETE FROM products WHERE id = $id"
);

header("Location:index.php");
exit;