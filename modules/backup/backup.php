<?php
include("../../includes/auth_admin.php");

$filename = "backup_" . date("Ymd_His") . ".sql";

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=$filename");

$command = "C:/xampp/mysql/bin/mysqldump --user=root tp_warehouse";
passthru($command);
exit;
?>