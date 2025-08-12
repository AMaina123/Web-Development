<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "Menerator.1");
define("DB_NAME", "webdevdb");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
//if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
// } else {
   // echo "Connected successfully to the database {webdevdb}.";
//}
?>