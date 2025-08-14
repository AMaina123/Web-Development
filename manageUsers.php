<?php
session_start();
require_once 'connection.php';

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
        echo "Cannot create another Super_User.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO users (Full_Name, email, phone_Number, User_Name, Password, UserType, Address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $full_name, $email, $phone, $username, $password, $usertype, $address);
        $stmt->execute();
        echo "User added successfully.";
    }
}

// Delete user
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    if ($deleteId !== $_SESSION['user']['userId']) {
        $stmt = $mysqli->prepare("DELETE FROM users WHERE userId=? AND UserType!='Super_User'");
        $stmt->bind_param("i", $deleteId);
        $stmt->execute();
        echo "User deleted.";
    } else {
        echo "Cannot delete yourself.";
    }
}
?>

<h2>Manage Other Users</h2>

<!-- Add User Form -->
<form method="POST">
    <input name="Full_Name" placeholder="Full Name" required><br>
    <input name="email" placeholder="Email" required><br>
    <input name="phone_Number" placeholder="Phone Number"><br>
    <input name="User_Name" placeholder="Username" required><br>
    <input name="Password" type="password" placeholder="Password" required><br>
    <select name="UserType" required>
        <option value="Administrator">Administrator</option>
        <option value="Author">Author</option>
    </select><br>
    <textarea name="Address" placeholder="Address"></textarea><br>
    <button type="submit" name="add_user">Add User</button>
</form>

<hr>

<!-- List Users -->
<h3>All Users (excluding Super_User)</h3>
<?php
$result = $mysqli->query("SELECT * FROM users WHERE UserType!='Super_User'");
while ($row = $result->fetch_assoc()) {
    echo "<div>
        <strong>{$row['Full_Name']}</strong> ({$row['UserType']})<br>
        Email: {$row['email']}<br>
        Username: {$row['User_Name']}<br>
        <a href='editUser.php?id={$row['userId']}'>Edit</a> |
        <a href='manageUsers.php?delete={$row['userId']}' onclick='return confirm(\"Delete this user?\")'>Delete</a>
        <hr>
    </div>";
}
?>