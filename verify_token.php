<?php
session_start();
include "database_conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $token = $_POST['token'];

    $stmt = $conn->prepare("SELECT token, token_expiry FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $data = $result->fetch_assoc();
        $stored_token = $data['token'];
        $expiry = $data['token_expiry'];

        if ($token === $stored_token) {
            if (strtotime($expiry) > time()) {
                // Token is valid, store email in session for next step
                $_SESSION['reset_email'] = $email;
                header("Location: reset_password.php");
                exit();
            } else {
                echo "<script>alert('❌ Token expired!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('❌ Invalid token!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('❌ Email not found!'); window.history.back();</script>";
    }
}
?>

<!-- Tailwind Styled Form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Verify Token</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-400 to-purple-500">
  <form method="POST" class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Verify Code</h2>

    <label class="block mb-4">
      <span class="text-gray-700">Email</span>
      <input type="email" name="email" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-400">
    </label>

    <label class="block mb-6">
      <span class="text-gray-700">Enter Code</span>
      <input type="text" name="token" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-400">
    </label>

    <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded hover:bg-indigo-700">Verify Code</button>
  </form>
</body>
</html>
