<?php
include "../includes/config.php";

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $conn->query("DELETE FROM users WHERE id = $user_id");
    header("Location: users.php");
}
?>
