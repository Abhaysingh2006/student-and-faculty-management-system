<?php
include 'database_conn.php';

// 1. Validate faculty ID
if (!isset($_GET['id'])) {
    header("Location: admin_dashborad.php");
    exit();
}

$id = $_GET['id'];

// 2. Fetch faculty data
$query = "SELECT * FROM faculty WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) !== 1) {
    echo "Faculty member not found.";
    exit();
}

$faculty = mysqli_fetch_assoc($result);

// 3. Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $experience = $_POST['experience'];
    $father_name = $_POST['father_name'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];

    $update_query = "UPDATE faculty SET 
        name = '$name',
        age = '$age',
        experience = '$experience',
        father_name = '$father_name',
        address = '$address',
        course = '$course',
        designation = '$designation',
        salary = '$salary'
        WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>
            alert('Faculty updated successfully!');
            window.location.href='admin_dashborad.php';
        </script>";
        exit();
    } else {
        echo "Error updating faculty: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Faculty</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
  <div class="bg-white w-full max-w-3xl p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-green-700 text-center">Edit Faculty - <?= htmlspecialchars($faculty['name']) ?></h1>

    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block font-semibold mb-1">Faculty Name</label>
        <input type="text" name="name" value="<?= $faculty['name'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <div>
        <label class="block font-semibold mb-1">Age</label>
        <input type="number" name="age" value="<?= $faculty['age'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <div>
        <label class="block font-semibold mb-1">Experience</label>
        <input type="text" name="experience" value="<?= $faculty['experience'] ?>" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <div>
        <label class="block font-semibold mb-1">Father's Name</label>
        <input type="text" name="father_name" value="<?= $faculty['father_name'] ?>" class="w-full border border-gray-300 p-2 rounded">
      </div>

      <div class="md:col-span-2">
        <label class="block font-semibold mb-1">Address</label>
        <textarea name="address" rows="3" class="w-full border border-gray-300 p-2 rounded"><?= $faculty['address'] ?></textarea>
      </div>

      <div>
        <label class="block font-semibold mb-1">Course</label>
        <input type="text" name="course" value="<?= $faculty['course'] ?>" class="w-full border border-gray-300 p-2 rounded">
      </div>

      <div>
        <label class="block font-semibold mb-1">Designation</label>
        <input type="text" name="designation" value="<?= $faculty['designation'] ?>" class="w-full border border-gray-300 p-2 rounded">
      </div>

      <div>
        <label class="block font-semibold mb-1">Salary</label>
        <input type="text" name="salary" value="<?= $faculty['salary'] ?>" class="w-full border border-gray-300 p-2 rounded">
      </div>

      <div class="col-span-1 md:col-span-2 flex justify-between mt-6">
        <a href="admin_dashborad.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Update Faculty</button>
      </div>
    </form>
  </div>
</body>
</html>
