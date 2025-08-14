<?php
session_start();
require_once 'connection.php';

$user = $_SESSION['user'];
if (!$user) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['Full_Name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_Number'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $address = $_POST['Address'];

    $stmt = $mysqli->prepare("UPDATE users SET Full_Name=?, email=?, phone_Number=?, Password=?, Address=? WHERE userId=?");
    $stmt->bind_param("sssssi", $full_name, $email, $phone, $password, $address, $user['userId']);
    $stmt->execute();

    echo "Profile updated.";
}
?>

<form method="POST">
    <input name="Full_Name" value="<?= $user['Full_Name'] ?>" required><br>
    <input name="email" value="<?= $user['email'] ?>" required><br>
    <input name="phone_Number" value="<?= $user['phone_Number'] ?>" required><br>
    <input name="Password" type="password" placeholder="New Password" required><br>
    <textarea name="Address"><?= $user['Address'] ?></textarea><br>
    <button type="submit">Update</button>
</form>