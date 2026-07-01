<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|-------------------------------------------------
| CHẶN TRUY CẬP KHI CHƯA LOGIN
|-------------------------------------------------
*/

if (empty($_SESSION['admin']['id'])) {

    // Xóa session nếu có lỗi tồn tại rác
    unset($_SESSION['admin']);
    session_destroy();

    header("Location: /Warehouse-App/admin/login.php");
    exit;
}
?>