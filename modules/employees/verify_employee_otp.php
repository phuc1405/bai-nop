<?php

session_start();

include("../../includes/auth_admin.php");
include("../../config/database.php");

require("../../admin/send_account.php");

if(!isset($_SESSION['new_employee'])){
    die("Không có dữ liệu nhân viên!");
}

$msg = "";

if(isset($_POST['verify'])){

    $otp = trim($_POST['otp']);

    if($otp == $_SESSION['new_employee']['otp']){

        $username = $_SESSION['new_employee']['username'];
        $password = $_SESSION['new_employee']['password'];
        $fullname = $_SESSION['new_employee']['fullname'];
        $email    = $_SESSION['new_employee']['email'];
        $role     = $_SESSION['new_employee']['role'];

        mysqli_query($conn,"
            INSERT INTO users(
                username,
                password,
                fullname,
                email,
                role
            )
            VALUES(
                '$username',
                '$password',
                '$fullname',
                '$email',
                '$role'
            )
        ");

        sendAccountInfo(
            $email,
            $username,
            $password
        );

        unset($_SESSION['new_employee']);

        echo "<script>
        alert('Tạo nhân viên thành công!');
        window.location='index.php';
        </script>";
        exit;

    }else{

        $msg = "OTP không đúng!";

    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Xác thực OTP</title>
</head>
<body>

<h2>Xác thực Email Nhân Viên</h2>

<form method="POST">

    <input
        type="text"
        name="otp"
        placeholder="Nhập OTP"
        required
    >

    <button name="verify">
        Xác nhận
    </button>

</form>

<br>

<?= $msg ?>

</body>
</html>