<?php
session_start();
require 'constant.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE User_Name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['user'] = $user;

        switch ($user['UserType']) {
            case 'Super_User':
                header("Location: Logic/superUser.php");
                exit;
            case 'Administrator':
                header("Location: Logic/Admin.php");
                exit;
            case 'Author':
                header("Location: Logic/Author.php");
                exit;
            default:
                echo "Unknown user type.";
        }
    } else {
        echo "Invalid credentials.";
    }
} else {
    echo "Please enter both username and password.";
}
?>