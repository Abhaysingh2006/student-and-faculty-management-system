<?php
include 'database_conn.php';

// Step 1: Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $faculty_id = $_POST['faculty_id'];
    $batch_timing = $_POST['batch_timing'];

    // Prevent duplicate entries
    $check = mysqli_query($conn, "SELECT * FROM faculty_batches WHERE faculty_id = $faculty_id AND batch_timing = '$batch_timing'");
    if (mysqli_num_rows($check) === 0) {
        $query = "INSERT INTO faculty_batches (faculty_id, batch_timing) VALUES ($faculty_id, '$batch_timing')";
        if (mysqli_query($conn, $query)) {
            $message = "Batch assigned successfully!";
        } else {
            $message = "Error assigning batch: " . mysqli_error($conn);
        }
    } else {
        $message = "This batch is already assigned to this faculty.";
    }
}

// Step 2: Get all faculty
$faculty_list = mysqli_query($conn, "SELECT id, name FROM faculty");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Assign Batch to Faculty</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 min-h-screen">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-center text-indigo-600 mb-4">Assign Batch to Faculty</h1>
   <a href="admin_dashborad.php" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">
    ⬅ Back to Dashboard
  </a>
    <?php if (isset($message)): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <!-- Faculty Dropdown -->
      <div>
        <label class="block mb-1 font-semibold">Select Faculty</label>
        <select name="faculty_id" class="w-full border border-gray-300 p-2 rounded" required>
          <option value="">-- Select Faculty --</option>
          <?php while ($row = mysqli_fetch_assoc($faculty_list)): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Batch Timing Input -->
      <div>
  <label class="block mb-1 font-semibold">Select Batch Timing</label>
  <select name="batch_timing" class="w-full border border-gray-300 p-2 rounded" required>
    <option value="">-- Select Batch Timing --</option>
    <option value="MWF-(7:30AM-9:00AM)">MWF-(7:30AM-9:00AM)</option>
    <option value="TTS-(7:30AM-9:00AM)">TTS-(7:30AM-9:00AM)</option>
    <option value="MWF-(9:00AM-10:30AM)">MWF-(9:00AM-10:30AM)</option>
    <option value="TTS-(9:00AM-10:30AM)">TTS-(9:00AM-10:30AM)</option>
    <option value="MWF-(10:30AM-12:00PM)">MWF-(10:30AM-12:00PM)</option>
    <option value="TTS-(10:30AM-12:00PM)">TTS-(10:30AM-12:00PM)</option>
    <option value="MWF-(12:00PM-1:30PM)">MWF-(12:00PM-1:30PM)</option>
    <option value="TTS-(12:00PM-1:30PM)">TTS-(12:00PM-1:30PM)</option>
    <option value="MWF-(2:00PM-3:30PM)">MWF-(2:00PM-3:30PM)</option>
    <option value="TTS-(2:00PM-3:30PM)">TTS-(2:00PM-3:30PM)</option>
    <option value="MWF-(3:30PM-05:00PM)">MWF-(3:30PM-05:00PM)</option>
    <option value="TTS-(3:30PM-05:00PM)">TTS-(3:30PM-05:00PM)</option>
    <option value="MWF-(5:00PM-6:30PM)">MWF-(5:00PM-6:30PM)</option>
    <option value="TTS-(5:00PM-6:30PM)">TTS-(5:00PM-6:30PM)</option>
  </select>
</div>


      <!-- Submit -->
      <div class="text-right">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Assign Batch</button>
      </div>
    </form>
  </div>
</body>
</html>
