<?php
// Database credentials
$db_host = "localhost";
$db_user = "xbasoxxc_xbasoxxc";
$db_password = "xbasoxxc_xbasoxxc";
$db_name = "xbasoxxc_test";

// Attempt to establish a connection to the MySQL database
$dbcon = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check if the connection was successful
if (!$dbcon) {
    die("Connection failed: " . mysqli_connect_error());
}
?>