<?php
session_start();
include "database_conn.php";

// Ensure email is available via session
if (!isset($_SESSION['reset_email'])) {
    echo "<script>alert('Unauthorized access!'); window.location.href = 'forget_password.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_SESSION['reset_email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('❌ Passwords do not match!');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update password and clear token
        $stmt = $conn->prepare("UPDATE admins SET password = ?, token = NULL, token_expiry = NULL WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            // Unset session to prevent reuse
            unset($_SESSION['reset_email']);
            echo "<script>alert('✅ Password changed successfully!'); window.location.href = 'admin_signin.php';</script>";
        } else {
            echo "<script>alert('❌ Error updating password.');</script>";
        }
    }
}
?>

<!-- Tailwind Styled Reset Form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-red-400 to-orange-500">
  <form method="POST" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Reset Your Password</h2>

    <label class="block mb-4">
      <span class="text-gray-700">New Password</span>
      <input type="password" name="password" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-red-400">
    </label>

    <label class="block mb-6">
      <span class="text-gray-700">Confirm Password</span>
      <input type="password" name="confirm_password" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-red-400">
    </label>

    <button type="submit" class="w-full bg-red-600 text-white font-semibold py-2 rounded hover:bg-red-700">Change Password</button>
  </form>
</body>
</html>
