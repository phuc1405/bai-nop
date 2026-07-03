<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../src/PHPMailer.php');
require_once(__DIR__ . '/../src/SMTP.php');
require_once(__DIR__ . '/../src/Exception.php');

function sendAccountInfo($email,$username,$password){

    $mail = new PHPMailer(true);

    try{

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        $mail->Username = 'bebay01011956@gmail.com';

        // App Password Gmail
        $mail->Password = 'gbgjnsmrffzozsrz';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom(
            'bebay01011956@gmail.com',
            'TP Warehouse'
        );

        $mail->addAddress($email);

        $mail->Subject = 'Thong tin tai khoan TP Warehouse';

        $mail->Body =
"Xin chao!

Tai khoan cua ban da duoc tao.

Username: $username

Password: $password

Vui long dang nhap va doi mat khau sau khi nhan tai khoan.

TP Warehouse";

        $mail->send();

        return true;

    }catch(Exception $e){

        return false;

    }
}