<?php
include("../../includes/auth_admin.php");
$msg = "";

if($_SERVER['REQUEST_METHOD']=="POST"){

    $file = $_FILES['sql_file']['tmp_name'];

    if($file){

        $command = "C:/xampp/mysql/bin/mysql -u root tp_warehouse < \"$file\"";
        exec($command);

        $msg = "Restore thành công!";
    }
}
?>

<link rel="stylesheet" href="../../assets/css/products.css">

<div class="container">
    <div class="form-box">

        <h1>Restore Database</h1>

        <?php if($msg){ ?>
            <p><?= $msg ?></p>
        <?php } ?>

        <form method="POST" enctype="multipart/form-data">

            <input type="file" name="sql_file" required>

            <br><br>

            <button name="restore" class="btn-save">
                Restore
            </button>

        </form>

    </div>
</div>