<?php
session_start();
require 'constant.php';

$user = $_SESSION['user'];
if (!$user) {
    header("Location: index.php");
    exit;
}

$updateMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['Full_Name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_Number'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $address = $_POST['Address'];

    $stmt = $mysqli->prepare("UPDATE users SET Full_Name=?, email=?, phone_Number=?, Password=?, Address=? WHERE userId=?");
    $stmt->bind_param("sssssi", $full_name, $email, $phone, $password, $address, $user['userId']);
    $stmt->execute();

    $updateMessage = "✅ Profile updated successfully.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LegalGuide | Update Profile</title>
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

    .form-container {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    input, textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #2c3e50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #34495e;
    }

    .message {
      text-align: center;
      margin-bottom: 15px;
      color: green;
      font-size: 14px;
    }

    .footer-note {
      text-align: center;
      margin-top: 20px;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Update Your Profile</h2>

    <?php if ($updateMessage): ?>
      <div class="message"><?= $updateMessage ?></div>
    <?php endif; ?>

    <form method="POST">
      <label>Full Name</label>
      <input name="Full_Name" value="<?= htmlspecialchars($user['Full_Name']) ?>" required>
        <label>Email</label>
      <input name="email" type="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        <label>Phone Number</label>
      <input name="phone_Number" value="<?= htmlspecialchars($user['phone_Number']) ?>" required>
        <label>Password</label>
      <input name="Password" type="password" placeholder="New Password" required>
        <label>Address</label>
      <textarea name="Address" rows="4"><?= htmlspecialchars($user['Address']) ?></textarea>
      <button type="submit">Update</button>
    </form>

    <div class="footer-note">© Authorship 2025. All rights reserved.</div>
  </div>
</body>
</html>