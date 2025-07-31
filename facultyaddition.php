<?php
include 'database_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $experience = $_POST['experience'];
    $father = $_POST['father'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];

    $query = "INSERT INTO faculty (name, age, experience, father_name, address, course, designation, salary)
              VALUES ('$name', '$age', '$experience', '$father', '$address', '$course', '$designation', '$salary')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('FACULTY ADDED IN DATABASE.');
            window.location.href = 'admin_dashborad.php';
        </script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
