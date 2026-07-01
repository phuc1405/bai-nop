<?php

include("../../includes/auth_admin.php");
include("../../config/database.php");

if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    mysqli_query($conn,"DELETE FROM imports WHERE id=$id");

}

header("Location: index.php");
exit;