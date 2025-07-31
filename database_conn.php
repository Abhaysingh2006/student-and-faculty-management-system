<?php
$host = "localhost";         // or 127.0.0.1
$user = "root";              // default for XAMPP
$password = "";              // empty by default in XAMPP
$database = "alldata"; // your DB name

$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>