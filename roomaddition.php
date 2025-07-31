<?php
include 'database_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_no = $_POST['room_no'];
    $capacity = $_POST['capacity'];

    $query = "INSERT INTO rooms (room_number, capacity)
              VALUES ('$room_no', '$capacity')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('ROOM ADDED IN DATABASE.');
            window.location.href = 'admin_dashborad.php';
        </script>";
        exit();
    }  else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
