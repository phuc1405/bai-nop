<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../../admin/login.php");
    exit;
}

include("../../config/database.php");

if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    // Lấy tên file hợp đồng
    $result = mysqli_query(
        $conn,
        "SELECT file FROM contracts WHERE id='$id'"
    );

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        // Xóa file nếu tồn tại
        if($row['file'] != ""){

            $path = "../../assets/contracts/" . $row['file'];

            if(file_exists($path)){
                unlink($path);
            }

        }

        // Xóa dữ liệu
        mysqli_query(
            $conn,
            "DELETE FROM contracts WHERE id='$id'"
        );

    }

}

header("Location: index.php");
exit;
?>