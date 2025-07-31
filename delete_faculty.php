<?php
include 'database_conn.php';

// ✅ 1. Check if ID is passed
if (!isset($_GET['id'])) {
    header("Location: admin_dashborad.php");
    exit();
}

$id = $_GET['id'];

// ✅ 2. Delete faculty from database
$query = "DELETE FROM faculty WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Faculty member deleted successfully!');
        window.location.href='admin_dashborad.php';
    </script>";
    exit();
} else {
    echo "Error deleting faculty: " . mysqli_error($conn);
}
?>
