<?php
include 'database_conn.php';

// 1. Check if ID is passed
if (!isset($_GET['id'])) {
    header("Location: admin_dashborad.php");
    exit();
}

$id = $_GET['id'];

// 2. Fetch student details
$query = "SELECT * FROM students WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) !== 1) {
    echo "Student not found.";
    exit();
}

$student = mysqli_fetch_assoc($result);

// 3. Update logic
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $roll_no = $_POST['roll_no'];
    $course = $_POST['course'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $batch = $_POST['batch_timing'];
    $mobile = $_POST['mobile_number'];
    $counsellor = $_POST['counsellor_name'];
    $join_date = $_POST['joining_date'];

    $update_query = "UPDATE students SET 
        name='$name',
        age='$age',
        roll_no='$roll_no',
        course='$course',
        father_name='$father_name',
        mother_name='$mother_name',
        batch_timing='$batch',
        mobile_number='$mobile',
        counsellor_name='$counsellor',
        joining_date='$join_date'
        WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>
            alert('Student updated successfully!');
            window.location.href='admin_dashborad.php';
        </script>";
        exit();
    } else {
        echo "Error updating student: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Student</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
  <div class="bg-white w-full max-w-4xl p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-indigo-700 text-center">Edit Student - <?= htmlspecialchars($student['name']) ?></h1>

    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <!-- Name -->
      <div>
        <label class="block font-semibold mb-1">Student Name</label>
        <input type="text" name="name" value="<?= $student['name'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <!-- Age -->
      <div>
        <label class="block font-semibold mb-1">Age</label>
        <input type="number" name="age" value="<?= $student['age'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <!-- Roll No -->
      <div>
        <label class="block font-semibold mb-1">Roll Number</label>
        <input type="text" name="roll_no" value="<?= $student['roll_no'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <!-- Course -->
      <div>
        <label class="block font-semibold mb-1">Course</label>
        <input type="text" name="course" value="<?= $student['course'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <!-- Father's Name -->
      <div>
        <label class="block font-semibold mb-1">Father's Name</label>
        <input type="text" name="father_name" value="<?= $student['father_name'] ?>" class="w-full border border-gray-300 p-2 rounded">
      </div>

      <!-- Mother's Name -->
      <div>
        <label class="block font-semibold mb-1">Mother's Name</label>
        <input type="text" name="mother_name" value="<?= $student['mother_name'] ?>" class="w-full border border-gray-300 p-2 rounded">
      </div>

      <!-- Batch Timing --> 
<div>
  <label class="block font-semibold mb-1">Batch Timing</label>
  <select name="batch_timing" class="w-full rounded px-3 py-2 bg-indigo-800 text-white border border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
    <?php
    $batch_timings = [
      "MWF-(7:30AM-9:00AM)",
      "TTS-(7:30AM-9:00AM)",
      "MWF-(9:00AM-10:30AM)",
      "TTS-(9:00AM-10:30AM)",
      "MWF-(10:30AM-12:00PM)",
      "TTS-(10:30AM-12:00PM)",
      "MWF-(12:00PM-1:30PM)",
      "TTS-(12:00PM-1:30PM)",
      "MWF-(2:00PM-3:30PM)",
      "TTS-(2:00PM-3:30PM)",
      "MWF-(3:30PM-05:00PM)",
      "TTS-(3:30PM-05:00PM)",
      "MWF-(5:00PM-6:30PM)",
      "TTS-(5:00PM-6:30PM)"
    ];

    foreach ($batch_timings as $timing) {
      $selected = ($student['batch_timing'] == $timing) ? 'selected' : '';
      echo "<option value=\"$timing\" $selected>$timing</option>";
    }
    ?>
  </select>
</div>

      <!-- Mobile Number -->
      <div>
        <label class="block font-semibold mb-1">Mobile Number</label>
        <input type="text" name="mobile_number" value="<?= $student['mobile_number'] ?>" class="w-full border border-gray-300 p-2 rounded">
      </div>

      <!-- Counsellor Name -->
      <div>
        <label class="block font-semibold mb-1">Counsellor Name</label>
        <input type="text" name="counsellor_name" value="<?= $student['counsellor_name'] ?>" class="w-full border border-gray-300 p-2 rounded">
      </div>

      <!-- Joining Date -->
      <div>
        <label class="block font-semibold mb-1">Joining Date</label>
        <input type="date" name="joining_date" value="<?= $student['joining_date'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <!-- Buttons -->
      <div class="col-span-1 md:col-span-2 flex justify-between mt-6">
        <a href="admin_dashborad.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Student</button>
      </div>
    </form>
  </div>
</body>
</html>
