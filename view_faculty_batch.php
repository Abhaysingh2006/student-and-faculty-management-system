<?php
include 'database_conn.php';

$query = "
  SELECT fb.id, f.name AS faculty_name, fb.batch_timing
  FROM faculty_batches fb
  JOIN faculty f ON fb.faculty_id = f.id
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Assigned Faculty Batches</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-indigo-700">Assigned Batches to Faculty</h2>
<a href="admin_dashborad.php" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">
    ⬅ Back to Dashboard
  </a>
    <table class="min-w-full text-sm">
      <thead class="bg-indigo-200 text-indigo-900">
        <tr>
          <th class="p-2">Faculty Name</th>
          <th class="p-2">Batch Timing</th>
          <th class="p-2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <tr class="border-b hover:bg-gray-100">
            <td class="p-2"><?= htmlspecialchars($row['faculty_name']) ?></td>
            <td class="p-2"><?= htmlspecialchars($row['batch_timing']) ?></td>
            <td class="p-2">
              <a href="delete_faculty_batch.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to remove this batch?');" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                Remove
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
