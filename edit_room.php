<?php
include 'database_conn.php';

// 1. Validate ID
if (!isset($_GET['id'])) {
    header("Location: admin_dashborad.php");
    exit();
}

$id = $_GET['id'];

// 2. Fetch room info
$query = "SELECT * FROM rooms WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) !== 1) {
    echo "Room not found.";
    exit();
}

$room = mysqli_fetch_assoc($result);

// 3. Update logic
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $room_number = $_POST['room_number'];
    $capacity = $_POST['capacity'];

    $update_query = "UPDATE rooms SET 
        room_number = '$room_number',
        capacity = '$capacity'
        WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>
            alert('Room updated successfully!');
            window.location.href='admin_dashborad.php';
        </script>";
        exit();
    } else {
        echo "Error updating room: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Room</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
  <div class="bg-white w-full max-w-md p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-yellow-700 text-center">Edit Room - <?= htmlspecialchars($room['room_number']) ?></h1>

    <form method="POST" class="grid gap-4">
      <div>
        <label class="block font-semibold mb-1">Room Number</label>
        <input type="text" name="room_number" value="<?= $room['room_number'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <div>
        <label class="block font-semibold mb-1">Capacity</label>
        <input type="number" name="capacity" value="<?= $room['capacity'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <div class="flex justify-between mt-6">
        <a href="admin_dashborad.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700">Update Room</button>
      </div>
    </form>
  </div>
</body>
</html>
