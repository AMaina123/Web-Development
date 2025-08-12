<?php
session_start();
require "db.php";

// Capture form inputs. ucwords auto uppercases the first string character, strtolower makes a string lowercase 
  $full_name   = ucwords(strtolower($_POST['full_name']?? ''));
  $email       = ucwords(strtolower($_POST['email'] ?? ''));
  $phone       = ucwords(strotolower($_POST['phone'] ?? ''));
  $username    = ucwords(strotolower($_POST['username'] ?? ''));
  $password    = ucwords(strotolower($_POST['password'] ?? ''));
  $confirm     = ucwords(strotolower($_POST['confirm_password'] ?? ''));
  $role_id     = ucwords(strotolower($_POST['role_id'] ?? ''));
  $gender_id   = ucwords(strotolower($_POST['gender_id'] ?? ''));
  
// 🔐 Enforce password complexity
if (
  strlen($password) < 8 ||
  !preg_match('/[A-Z]/', $password) ||        // uppercase
  !preg_match('/[a-z]/', $password) ||        // lowercase
  !preg_match('/[0-9]/', $password)           // digit
) {
  die("Password must be at least 8 characters and include uppercase, lowercase, and a number.");
}

//  Password match check
if ($password !== $confirmPass) {
    die("Passwords do not match.");
}

//  Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//  Insert user into DB
$stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, username, password, gender_id, role_Id) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$fullName, $email, $phone, $username, $hashedPassword, $genderId, $roleId]);

//  Fetch the new user and their role name
$userId = $conn->lastInsertId();
$stmt = $conn->prepare("SELECT r.role FROM users u JOIN roles r ON u.role_id = r.roleId WHERE u.id = ?");
$stmt->execute([$userId]);
$role = $stmt->fetchColumn();

//  Set session
$_SESSION['user_id']    = $userId;
$_SESSION['user_email'] = $email;
$_SESSION['user_role']  = $role;

//  Redirect based on role
header("Location: Dashboard.php");
exit;
?>