<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "vibo_aesthetics";

// Create a connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    header("Location: ../Error/dberror.php");
    die();
    // die("Connection failed: " . $con->connect_error);
}
?>