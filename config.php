<?php
$host = "localhost";
$user = "root";  // Change if using a different user
$pass = "";      // Set a password if required
$dbname = "crm_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
