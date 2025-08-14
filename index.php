<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required /><br>
        <input type="password" name="password" placeholder="Password" required /><br>
        <button type="submit">Sign In</button>
    </form>
</body>
</html>