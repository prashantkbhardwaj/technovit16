<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "techno2480");
define("DB_NAME", "technovit16");

// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>