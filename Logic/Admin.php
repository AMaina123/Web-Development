<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['UserType'] !== 'Administrator') {
    header("Location: index.php");
    exit;
}
?>

<h2>Welcome Administrator</h2>
<a href="update_profile.php">Update My Profile</a><br>
<a href="manage_authors.php">Manage Authors</a><br>
<a href="view_articles.php">View Articles</a><br>
<a href="logout.php">Logout</a