<?php
session_start();
require 'constant.php';

if ($_SESSION['user']['UserType'] !== 'Administrator') {
    header("Location: index.php");
    exit;
}

// Add Author
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Full_Name'];
    $email = $_POST['email'];
    $username = $_POST['User_Name'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users (Full_Name, email, User_Name, Password, UserType) VALUES (?, ?, ?, ?, 'Author')");
    $stmt->bind_param("ssss", $name, $email, $username, $password);
    $stmt->execute();
    echo "Author added.";
}

// List Authors
$result = $mysqli->query("SELECT * FROM users WHERE UserType='Author'");
while ($row = $result->fetch_assoc()) {
    echo "{$row['Full_Name']} - {$row['email']} 
    <a href='edit_author.php?id={$row['userId']}'>Edit</a> 
    <a href='delete_author.php?id={$row['userId']}'>Delete</a><br>";
}
?>

<form method="POST">
    <input name="Full_Name" placeholder="Full Name" required><br>
    <input name="email" placeholder="Email" required><br>
    <input name="User_Name" placeholder="Username" required><br>
    <input name="Password" type="password" placeholder="Password" required><br>
    <button type="submit">Add Author</button>
</form>