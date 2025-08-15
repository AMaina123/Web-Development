<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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

    .login-container {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .error-message {
      color: red;
      margin-bottom: 15px;
      font-size: 14px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
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
      margin-top: 10px;
    }

    button:hover {
      background-color: #34495e;
    }

    .footer-note {
      margin-top: 20px;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>

    <?php
    if (isset($_GET['error'])) {
      switch ($_GET['error']) {
        case 'missing':
          echo '<div class="error-message">Please enter both username and password.</div>';
          break;
        case 'invalid':
          echo '<div class="error-message">Invalid credentials. Try again.</div>';
          break;
        case 'usertype':
          echo '<div class="error-message">Unknown user type. Contact support.</div>';
          break;
      }
    }
    ?>

    <form action="login.php" method="POST">
        <label>Username</label>
      <input type="text" name="username" placeholder="Username" required />
        <label>Password</label>
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Sign In</button>
      <button type="button" onclick="window.location.href='signup.php'">Sign Up</button>
    </form>

    <div class="footer-note">© Authorship 2025. All rights reserved.</div>
  </div>
</body>
</html>