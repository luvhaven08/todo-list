<?php
require 'db_conn.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: loginPage.php");
    exit();
}else{
    header("Location : homePage.php");
}
?>