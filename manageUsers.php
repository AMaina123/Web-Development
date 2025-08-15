<?php
session_start();
require 'constant.php';

// Access control
if (!isset($_SESSION['user']) || $_SESSION['user']['UserType'] !== 'Super_User') {
    header("Location: index.php");
    exit;
}

// Add new user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $full_name = $_POST['Full_Name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_Number'];
    $username = $_POST['User_Name'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $usertype = $_POST['UserType'];
    $address = $_POST['Address'];

    if ($usertype === 'Super_User') {
        $message = "❌ Cannot create another Super_User.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO users (Full_Name, email, phone_Number, User_Name, Password, UserType, Address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $full_name, $email, $phone, $username, $password, $usertype, $address);
        $stmt->execute();
        $message = "✅ User added successfully.";
    }
}

// Delete user
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    if ($deleteId !== $_SESSION['user']['userId']) {
        $stmt = $mysqli->prepare("DELETE FROM users WHERE userId=? AND UserType!='Super_User'");
        $stmt->bind_param("i", $deleteId);
        $stmt->execute();
        $message = "🗑️ User deleted.";
    } else {
        $message = "⚠️ Cannot delete yourself.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LegalGuide | Manage Users</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      padding: 40px;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2, h3 {
      text-align: center;
      color: #2c3e50;
    }

    .message {
      text-align: center;
      color: #27ae60;
      font-weight: bold;
      margin-bottom: 20px;
    }

    form {
      display: grid;
      gap: 10px;
      margin-bottom: 30px;
    }

    input, select, textarea, button {
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      background-color: #2980b9;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background-color: #3498db;
    }

    .user-card {
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 15px;
      background-color: #fafafa;
    }

    .user-card strong {
      color: #34495e;
    }

    .user-card a {
      color: #c0392b;
      text-decoration: none;
      margin-right: 10px;
    }

    .user-card a:hover {
      text-decoration: underline;
    }

    hr {
      border: none;
      border-top: 1px solid #eee;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Manage Other Users</h2>
    <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>

    <!-- Add User Form -->
    <form method="POST">
        <h3>Add New User</h3>
        <label>Full Name</label>
      <input name="Full_Name" placeholder="Full Name" required>
        <label>Email</label>
      <input name="email" placeholder="Email" required>
      <label>Phone Number</label>
      <input name="phone_Number" placeholder="Phone Number">
        <label>Username</label>
      <input name="User_Name" placeholder="Username" required>
      <label>Password</label>
      <input name="Password" type="password" placeholder="Password" required>
        <label>User Type</label>
      <select name="UserType" required>
        <option value="Administrator">Administrator</option>
        <option value="Author">Author</option>
      </select>
      <label>Address</label>
      <textarea name="Address" placeholder="Address"></textarea>
      <button type="submit" name="add_user"> Add User</button>
    </form>

    <hr>

    <!-- List Users -->
    <h3>All Users (excluding Super_User)</h3>
    <?php
    $result = $mysqli->query("SELECT * FROM users WHERE UserType!='Super_User'");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='user-card'>
            <strong>{$row['Full_Name']}</strong> ({$row['UserType']})<br>
            Email: {$row['email']}<br>
            Username: {$row['User_Name']}<br>
            <a href='editUser.php?id={$row['userId']}'> Edit</a>
            <a href='manageUsers.php?delete={$row['userId']}' onclick='return confirm(\"Delete this user?\")'>Delete</a>
        </div>";
    }
    ?>

    <!-- Back to Dashboard Button -->
<div style="text-align: center; margin-top: 30px;">
  <a href="superUser.php" style="
    display: inline-block;
    padding: 10px 20px;
    background-color: #27ae60;
    color: white;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.2s ease;
  ">⬅️ Back to Dashboard</a>
</div>
  </div>
</body>
</html>