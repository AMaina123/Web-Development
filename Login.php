<?php
session_start();
require_once 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $mysqli->prepare("SELECT * FROM users WHERE User_Name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['Password'])) {
    $_SESSION['user'] = $user;
    switch ($user['UserType']) {
        case 'Super_User': header("Location: super_user_dashboard.php"); break;
        case 'Administrator': header("Location: admin_dashboard.php"); break;
        case 'Author': header("Location: author_dashboard.php"); break;
    }
} else {
    echo "Invalid credentials.";
}
?>