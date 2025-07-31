<?php
include 'database_conn.php';

// Check if form was submitted with batch timing
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['batch']) && isset($_POST['course'])) {
    $batch = $_POST['batch'];
    $course=$_POST['course'];
    if($batch=="All" && $course!="All"){
      $query="SELECT * FROM STUDENTS WHERE course='$course'";
      $result = mysqli_query($conn, $query);
    }
    elseif($course=="All" && $batch!="All"){
      $query="SELECT * FROM STUDENTS WHERE batch_timing='$batch'";
      $result = mysqli_query($conn, $query);
    }
    elseif($course=="All" && $batch=="All"){
      $query="SELECT * FROM STUDENTS";
      $result = mysqli_query($conn, $query);
    }
    else{
    $query = "SELECT * FROM students WHERE batch_timing = '$batch' OR course = '$course'";
    $result = mysqli_query($conn, $query);
  }
} else {
    // If accessed directly or no batch provided, go back
    header("Location: admin_dashborad.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Students in <?= htmlspecialchars($batch) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <h1 class="text-2xl font-bold mb-4">Students in Batch: <?= htmlspecialchars($batch) ?></h1>

  <a href="admin_dashborad.php" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">
    ⬅ Back to Dashboard
  </a>

  <div class="overflow-x-auto bg-white p-4 rounded shadow">
    <div class="mb-4">
  <input type="text" id="studentSearch" onkeyup="filterStudents()" placeholder="Search by name, roll no, course..." class="w-full p-2 border border-gray-300 rounded" />
</div>

    <table class="min-w-full text-sm text-left">
  <thead>
    <tr class="bg-indigo-200 text-indigo-900">
      <th class="p-2">Name</th>
      <th class="p-2">Age</th>
      <th class="p-2">Roll No</th>
      <th class="p-2">Course</th>
      <th class="p-2">Father's Name</th>
      <th class="p-2">Mother's Name</th>
      <th class="p-2">Batch Timing</th>
      <th class="p-2">Mobile</th>
      <th class="p-2">Counsellor</th>
      <th class="p-2">Join Date</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr class="border-b hover:bg-indigo-50">
      <td class="p-2"><?= htmlspecialchars($row['name']) ?></td>
      <td class="p-2"><?= htmlspecialchars($row['age']) ?></td>
      <td class="p-2"><?= htmlspecialchars($row['roll_no']) ?></td>
      <td class="p-2"><?= htmlspecialchars($row['course']) ?></td>
      <td class="p-2"><?= htmlspecialchars($row['father_name']) ?></td>
      <td class="p-2"><?= htmlspecialchars($row['mother_name']) ?></td>
      <td class="p-2"><?= htmlspecialchars($row['batch_timing']) ?></td>
      <td class="p-2"><?= htmlspecialchars($row['mobile_number']) ?></td>
      <td class="p-2"><?= htmlspecialchars($row['counsellor_name']) ?></td>
      <td class="p-2"><?= htmlspecialchars($row['joining_date']) ?></td>
       <td class="p-2 flex gap-2">
            <a href="edit_student.php?id=<?= $row['id'] ?>" class="bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600">Edit</a>
            <a href="delete_student.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600">Delete</a>
          </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<script>
function filterStudents() {
  const input = document.getElementById("studentSearch");
  const filter = input.value.toLowerCase();
  const table = document.querySelector("table");
  const trs = table.querySelectorAll("tbody tr");

  trs.forEach(tr => {
    const text = tr.textContent.toLowerCase();
    if (text.includes(filter)) {
      tr.style.display = "";
    } else {
      tr.style.display = "none";
    }
  });
}
</script>

  </div>
</body>
</html>
