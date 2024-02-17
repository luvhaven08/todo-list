<?php
session_start();

// Unset all of the session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header("Location: index.php"); // Assuming index.php is your login page
exit();
?>
