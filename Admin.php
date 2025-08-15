<?php
session_start();
require 'constant.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['UserType'] !== 'Administrator') {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> Admin Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      padding: 40px;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
    }

    .admin-links {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .admin-links a {
      text-decoration: none;
      color: #2980b9;
      font-weight: bold;
      padding: 10px 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #ecf0f1;
      transition: background-color 0.2s ease;
    }

    .admin-links a:hover {
      background-color: #d0e4f7;
    }

    .footer-note {
      text-align: center;
      margin-top: 40px;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Welcome Administrator</h2>
    <div class="admin-links">
      <a href="updateProfile.php"> Update My Profile</a>
      <a href="manageAuthors.php"> Manage Authors</a>
      <a href="viewArticles.php"> View Articles</a>
      <a href="index.php?logout=true" style="color: #dc3545;">Logout</a>
    </div>
    <div class="footer-note">© Authorship 2025. Admin access only.</div>
  </div>
</body>
</html>