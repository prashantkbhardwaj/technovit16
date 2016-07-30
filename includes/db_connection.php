<?php
define("DB_SERVER", "localhost");
define("DB_USER", "##");
define("DB_PASS", "##");
define("DB_NAME", "##");

// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>