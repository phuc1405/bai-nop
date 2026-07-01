<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../admin/login.php");
    exit;
}

include("../../config/database.php");
include("../../includes/header.php");
?>

<link rel="stylesheet" href="/Warehouse-App/assets/css/dashboard.css">
<link rel="stylesheet" href="/Warehouse-App/assets/css/products.css">

<?php

$keyword = "";

if(isset($_GET['keyword'])){
    $keyword = trim($_GET['keyword']);
}

$sql = "SELECT * FROM products";

if($keyword != ""){
    $sql .= " WHERE product_name LIKE '%$keyword%'
              OR product_code LIKE '%$keyword%'";
}

$sql .= " ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>


<div class="wrapper">

    <?php include("../../components/sidebar.php"); ?>

    <div class="main">

        <?php include("../../components/navbar.php"); ?>

        <div class="content">

            <div class="container">

    <h1>Quản lý hàng hóa</h1>
    
<form method="GET" style="margin:20px 0;">
    <input
        type="text"
        name="keyword"
        placeholder="Tìm mã hoặc tên sản phẩm..."
        value="<?= $keyword ?>"
        style="padding:10px; width:300px;">

    <button type="submit" class="btn-save">
        Tìm
    </button>

    <a href="index.php" class="btn-add">
        Reset
    </a>
</form>

    <a href="create.php" class="btn-add">
        + Thêm sản phẩm
    </a>

    <table>

        <thead>

        <tr>
            <th>Thao tác</th>
            <th>ID</th>
            <th>Mã SP</th>
            <th>Tên sản phẩm</th>
            <th>Tồn kho</th>
            <th>Giá nhập</th>
            <th>Giá bán</th>
            <th>Ảnh</th>
        </tr>

        </thead>

        <tbody>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td>

                <img
                    src="../../assets/uploads/<?php echo $row['image']; ?>"
                    width="70"
                    height="70"
                    style="object-fit:cover;border-radius:8px;">

                            
            </td>

            <td><?= $row['id'] ?></td>

            <td><?= $row['product_code'] ?></td>

            <td><?= $row['product_name'] ?></td>

            <td><?= $row['quantity'] ?></td>

            <td><?= number_format($row['import_price']) ?></td>

            <td><?= number_format($row['sale_price']) ?></td>
            <td>

            <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">
                Sửa
                </a>

                    <a href="delete.php?id=<?= $row['id'] ?>"
                    class="btn-delete"
                    onclick="return confirm('Xóa sản phẩm này?')">

                    Xóa

            </a>

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