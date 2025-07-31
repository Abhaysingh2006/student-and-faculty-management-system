
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forget Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-500 to-purple-500 min-h-screen flex items-center justify-center p-4">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">🔐 Forgot Password</h2>

    <form id="forgotForm" method="POST" action="send_reset_code.php">
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-semibold mb-2">Email address</label>
        <input
          type="email"
          id="email"
          name="email"
          required
          class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400"
          placeholder="Enter your registered email"
        />
      </div>

      <button
        type="submit"
        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition"
      >
        Send Reset Link
      </button>
    </form>

    <p class="mt-4 text-sm text-center text-gray-600">
      Remember your password?
      <a href="admin_signin.php" class="text-indigo-600 hover:underline">Login here</a>
    </p>
  </div>

  <script>
    // Optional client-side validation feedback
    const form = document.getElementById("forgotForm");
    form.addEventListener("submit", function (e) {
      const email = document.getElementById("email").value;
      if (!email.includes("@")) {
        e.preventDefault();
        alert("Please enter a valid email address.");
      }
    });
  </script>
</body>
</html>
