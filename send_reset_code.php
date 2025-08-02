<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

include "database_conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Step 1: Check if email exists
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Step 2: Generate token and expiry
        $token = bin2hex(random_bytes(16)); // 32-char
        $expiry = date("Y-m-d H:i:s", strtotime("+15 minutes"));

        // Step 3: Store token in DB
        $stmt = $conn->prepare("UPDATE admins SET token = ?, token_expiry = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expiry, $email);
        $stmt->execute();

        // Step 4: Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
          $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'FAKE_EMAIL@gmail.com';         // Your Gmail address
        $mail->Password   = 'FAKE_APP_PASSEORD';  // Paste the app password here
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

            // Recipients
            $mail->setFrom('20abhay06@gmail.com', 'Password Reset');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Password Reset Code';
            $mail->Body    = "
                <p>Hello,</p>
                <p>Use the following code to reset your password:</p>
                <h2 style='color:#e3342f;'>$token</h2>
                <p>This code will expire in 15 minutes.</p>
            ";

            $mail->send();

            // Step 5: Save email in session and redirect
            $_SESSION['reset_email'] = $email;
            echo "<script>alert('✅ Reset code sent to your email.'); window.location.href='verify_token.php';</script>";

        } catch (Exception $e) {
            echo "<script>alert('❌ Mail error: {$mail->ErrorInfo}'); window.history.back();</script>";
        }

    } else {
        echo "<script>alert('❌ Email not registered.'); window.history.back();</script>";
    }
}
?>

