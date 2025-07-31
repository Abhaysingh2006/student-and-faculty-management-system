<?php
include 'database_conn.php';

// ✅ 1. Check if room ID is passed
if (!isset($_GET['id'])) {
    header("Location: admin_dashborad.php");
    exit();
}

$id = $_GET['id'];

// ✅ 2. Delete the room from DB
$query = "DELETE FROM rooms WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Room deleted successfully!');
        window.location.href='admin_dashborad.php';
    </script>";
    exit();
} else {
    echo "Error deleting room: " . mysqli_error($conn);
}
?>
