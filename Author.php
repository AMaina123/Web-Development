<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['UserType'] !== 'Author') {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LegalGuide | Author Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .dashboard-container {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
      text-align: center;
    }

    h2 {
      margin-bottom: 30px;
      color: #2c3e50;
    }

    a {
      display: block;
      margin: 12px 0;
      text-decoration: none;
      color: #2c3e50;
      font-size: 16px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      transition: background-color 0.2s ease;
    }

    a:hover {
      background-color: #ecf0f1;
    }

    .footer-note {
      margin-top: 30px;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <h2>Welcome, Author</h2>
    <a href="updateProfile.php">Update My Profile</a>
    <a href="manageMyArticles.php">Manage My Articles</a>
    <a href="viewArticles.php">View Articles</a>
    <a href="index.php?logout=true" style="color: #dc3545;">Logout</a>
    <div class="footer-note">© LegalGuide 2025. All rights reserved.</div>
  </div>
</body>
</html>  