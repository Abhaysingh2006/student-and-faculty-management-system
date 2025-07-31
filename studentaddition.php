<?php
include 'database_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $roll_no = $_POST['roll_no'];
    $course = $_POST['course'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $batch = $_POST['batch'];
    $mobile = $_POST['mobile'];
    $counsellor = $_POST['counsellor'];
    $join_date = $_POST['join_date'];

    $query = "INSERT INTO students (name, age, roll_no, course, father_name, mother_name, batch_timing, mobile_number, counsellor_name, joining_date) 
              VALUES ('$name', '$age', '$roll_no', '$course', '$father_name', '$mother_name', '$batch', '$mobile', '$counsellor', '$join_date')";
if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('STUDENT ADDED IN DATABASE.');
        window.location.href = 'admin_dashborad.php';
    </script>";
    exit();
} else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
