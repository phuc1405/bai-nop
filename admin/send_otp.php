<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../src/PHPMailer.php');
require_once(__DIR__ . '/../src/SMTP.php');
require_once(__DIR__ . '/../src/Exception.php');

function sendOTP($email, $otp)
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'bebay01011956@gmail.com';
        $mail->Password = 'gbgjnsmrffzozsrz';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        $mail->setFrom(
            'bebay01011956@gmail.com',
            'TP Warehouse'
        );

        $mail->addAddress($email);

        // Nhúng logo vào email
        $mail->addEmbeddedImage(
            __DIR__ . '/../assets/img/logo.png',
            'logo_tp'
        );

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->Subject = 'TP Warehouse - Mã OTP xác thực';

        $mail->Body = '
        <div style="
            font-family:Arial,sans-serif;
            max-width:650px;
            margin:auto;
            border:1px solid #ddd;
            border-radius:12px;
            overflow:hidden;
        ">

            <div style="
                background:#ffffff;
                padding:20px;
                text-align:center;
                border-bottom:1px solid #eee;
            ">
                <img src="cid:logo_tp"
                     alt="TP Warehouse"
                     style="height:80px;">
            </div>

            <div style="padding:35px;">

                <h2 style="color:#c40000;">
                    Khôi phục mật khẩu
                </h2>

                <p>Xin chào,</p>

                <p>
                    Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu
                    cho tài khoản TP Warehouse.
                </p>

                <p>
                    Vui lòng sử dụng mã OTP bên dưới:
                </p>

                <div style="
                    text-align:center;
                    background:#f7f7f7;
                    border:2px dashed #c40000;
                    padding:25px;
                    margin:25px 0;
                    border-radius:10px;
                    font-size:36px;
                    font-weight:bold;
                    color:#c40000;
                    letter-spacing:8px;
                ">
                    ' . $otp . '
                </div>

                <p>
                    Mã OTP có hiệu lực trong <b>5 phút</b>.
                </p>

                <p>
                    Nếu bạn không thực hiện yêu cầu này,
                    vui lòng bỏ qua email.
                </p>

            </div>

            <div style="
                background:#f5f5f5;
                padding:15px;
                text-align:center;
                color:#666;
                font-size:12px;
            ">
                © TP Warehouse Management System
            </div>

        </div>';

        $mail->send();

        return true;

    } catch (Exception $e) {

        echo "Lỗi PHPMailer: " . $mail->ErrorInfo;
        exit;
    }
}
?>