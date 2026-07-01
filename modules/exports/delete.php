<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location:../../admin/login.php");
    exit;
}

include("../../config/database.php");

$id=$_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM exports WHERE id='$id'"
);

header("Location:index.php");
exit;