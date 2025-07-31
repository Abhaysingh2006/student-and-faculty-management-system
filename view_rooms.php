<?php
include 'database_conn.php';

$query = "SELECT * FROM rooms";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Room Information</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <h1 class="text-2xl font-bold mb-4">Room Information</h1>

  <a href="admin_dashborad.php" class="bg-yellow-600 text-white px-4 py-2 rounded mb-4 inline-block">
    ⬅ Back to Dashboard
  </a>

  <div class="overflow-x-auto bg-white p-4 rounded shadow">
    <table class="min-w-full text-sm text-left">
      <thead>
        <tr class="bg-yellow-200 text-yellow-900">
          <th class="p-2">Room Number</th>
          <th class="p-2">Capacity</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr class="border-b hover:bg-yellow-50">
          <td class="p-2"><?= htmlspecialchars($row['room_number']) ?></td>
          <td class="p-2"><?= htmlspecialchars($row['capacity']) ?></td>
           <td class="p-2 flex gap-2">
            <a href="edit_room.php?id=<?= $row['id'] ?>" class="bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600">Edit</a>
            <a href="delete_room.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
