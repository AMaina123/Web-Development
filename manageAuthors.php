<?php
session_start();
require 'constant.php';

if ($_SESSION['user']['UserType'] !== 'Administrator') {
    header("Location: index.php");
    exit;
}

// Add Author
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Full_Name'];
    $email = $_POST['email'];
    $username = $_POST['User_Name'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users (Full_Name, email, User_Name, Password, UserType) VALUES (?, ?, ?, ?, 'Author')");
    $stmt->bind_param("ssss", $name, $email, $username, $password);
    $stmt->execute();
    $message = "✅ Author added successfully.";
}

// List Authors
$result = $mysqli->query("SELECT * FROM users WHERE UserType='Author'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LegalGuide | Manage Authors</title>
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
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
    }

    .message {
      background-color: #dff0d8;
      color: #3c763d;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
      text-align: center;
    }

    .author-list {
      margin-bottom: 40px;
    }

    .author-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #eee;
    }

    .author-info {
      font-size: 14px;
      color: #333;
    }

    .author-actions a {
      margin-left: 10px;
      text-decoration: none;
      color: #2980b9;
      font-weight: bold;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    input, button {
      padding: 10px;
      font-size: 14px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {
      background-color: #2980b9;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #1c5980;
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
    <h2>Manage Authors</h2>

    <?php if ($message): ?>
      <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <div class="author-list">
        <label>Existing Authors</label>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="author-item">
          <div class="author-info">
            <?= htmlspecialchars($row['Full_Name']) ?> – <?= htmlspecialchars($row['email']) ?>
          </div>
          <div class="author-actions">
            <a href="edit_author.php?id=<?= $row['userId'] ?>">Edit</a>
            <a href="delete_author.php?id=<?= $row['userId'] ?>">Delete</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <form method="POST">
      <input name="Full_Name" placeholder="Full Name" required>
      <input name="email" placeholder="Email" required>
      <input name="User_Name" placeholder="Username" required>
      <input name="Password" type="password" placeholder="Password" required>
      <button type="submit"> Add Author</button>
    </form>

    <!-- Back to Dashboard Button -->
<div style="text-align: center; margin-top: 30px;">
  <a href="Admin.php" style="
    display: inline-block;
    padding: 10px 20px;
    background-color: #27ae60;
    color: white;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.2s ease;
  "> Back to Dashboard</a>
</div>
    <div class="footer-note">© Authorship 2025. Admin access only.</div>
  </div>
</body>
</html>