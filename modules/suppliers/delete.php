<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../admin/login.php");
    exit;
}

include("../../config/database.php");

if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM suppliers WHERE id='$id'"
    );
}

header("Location: index.php");
exit;