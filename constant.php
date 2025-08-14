<?php
define('HOST_NAME', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'Menerator.1');
define('DB_NAME', 'webdevdb');

$mysqli = new mysqli(HOST_NAME, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
