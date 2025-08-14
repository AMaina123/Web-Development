<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['UserType'] !== 'Author') {
    header("Location: index.php");
    exit;
}
?>

<h2>Welcome Author</h2>
<a href="update_profile.php">Update My Profile</a><br>
<a href="manage_my_articles.php">Manage My Articles</a><br>
<a href="view_articles.php">View Articles</a><br>
<a href="logout.php">Logout</a>