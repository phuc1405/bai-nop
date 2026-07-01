<?php

include("../../includes/auth_admin.php");

include("../../config/database.php");

$id=(int)$_GET['id'];

mysqli_query(
$conn,
"DELETE FROM users WHERE id=$id"
);

header("Location:index.php");

exit;