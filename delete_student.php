<?php
include 'database_conn.php';

// Check if 'id' is passed in URL
if (!isset($_GET['id'])) {
    header("Location: admin_dashborad.php");
    exit();
}

$id = $_GET['id'];

// Delete the student
$query = "DELETE FROM students WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Student deleted successfully!');
        window.location.href='admin_dashborad.php';
    </script>";
    exit();
} else {
    echo "Error deleting student: " . mysqli_error($conn);
}
?>
