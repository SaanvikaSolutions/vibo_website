<?php
include("./connections/dbconnect.php");

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// unset all session variables 
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the index page with a logout message
echo "<script>alert('successfully logged out.'); window.location.href='login.php';</script>";
exit;

?>