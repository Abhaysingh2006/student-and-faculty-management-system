<?php
include 'database_conn.php';

// Fetch faculty list for dropdown
$faculties = mysqli_query($conn, "SELECT id, name FROM faculty");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Check Faculty Batch</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 min-h-screen">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-center text-indigo-700 mb-6">Check Students Taught by Faculty</h1>
   <a href="admin_dashborad.php" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">
    ⬅ Back to Dashboard
  </a>
    <!-- FORM -->
    <form method="POST" action="check_faculty_batch.php" class="space-y-4">
      <!-- Faculty dropdown -->
      <div>
        <label class="block font-semibold mb-1">Select Faculty</label>
        <select name="faculty_id" class="w-full border border-gray-300 p-2 rounded" required>
          <option value="">-- Select Faculty --</option>
          <?php while ($row = mysqli_fetch_assoc($faculties)): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Batch timing dropdown -->
      <div>
        <label class="block font-semibold mb-1">Select Batch Timing</label>
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
            
      <!-- Submit button -->
      <div class="text-right">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Check Students</button>
      </div>
    </form>

    <!-- PHP Logic -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $faculty_id = $_POST['faculty_id'];
        $batch_timing = $_POST['batch_timing'];

        // Check if faculty is assigned to that batch
        $check = mysqli_query($conn, "SELECT * FROM faculty_batches WHERE faculty_id = $faculty_id AND batch_timing = '$batch_timing'");

        if (mysqli_num_rows($check) === 0) {
            echo '<div class="mt-6 bg-yellow-100 text-yellow-800 p-4 rounded text-center font-semibold">This faculty is free on this time.</div>';
        } else {
            // Get faculty name
            $faculty_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM faculty WHERE id = $faculty_id"));
            $faculty_name = $faculty_info['name'];

            // Fetch students from that batch
            $students = mysqli_query($conn, "SELECT * FROM students WHERE batch_timing = '$batch_timing'");

            if (mysqli_num_rows($students) > 0) {
                echo '<div class="mt-6 bg-green-100 text-green-800 p-4 rounded font-semibold text-center">';
                echo "Students taught by <strong>" . htmlspecialchars($faculty_name) . "</strong> in batch <strong>" . htmlspecialchars($batch_timing) . "</strong>:</div>";

                echo '<div class="overflow-x-auto mt-4 bg-white p-4 rounded shadow">';
                echo '<table class="min-w-full text-sm text-left">';
                echo '<thead><tr class="bg-indigo-200 text-indigo-900">';
                echo '<th class="p-2">Name</th>';
                echo '<th class="p-2">Roll No</th>';
                echo '<th class="p-2">Course</th>';
                echo '<th class="p-2">Mobile</th>';
                echo '</tr></thead><tbody>';

                while ($row = mysqli_fetch_assoc($students)) {
                    echo '<tr class="border-b hover:bg-gray-100">';
                    echo '<td class="p-2">' . htmlspecialchars($row['name']) . '</td>';
                    echo '<td class="p-2">' . htmlspecialchars($row['roll_no']) . '</td>';
                    echo '<td class="p-2">' . htmlspecialchars($row['course']) . '</td>';
                    echo '<td class="p-2">' . htmlspecialchars($row['mobile_number']) . '</td>';
                    echo '</tr>';
                }

                echo '</tbody></table></div>';
            } else {
                echo '<div class="mt-6 bg-red-100 text-red-800 p-4 rounded text-center font-semibold">No students found for this batch.</div>';
            }
        }
    }
    ?>
  </div>
</body>
</html>
