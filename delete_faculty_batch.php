<?php
include 'database_conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = mysqli_query($conn, "DELETE FROM faculty_batches WHERE id = $id");

    if ($delete) {
        header("Location: view_faculty_batch.php?msg=Batch+Removed+Successfully");
        exit();
    } else {
        echo "Error deleting batch.";
    }
} else {
    header("Location: view_faculty_batches.php");
    exit();
}
