<?php
session_start();
require 'constant.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['UserType'] !== 'Author') {
    header("Location: index.php");
    exit;
}
?>

<h2>Welcome Author</h2>
<a href="updateProfile.php">Update My Profile</a><br>
<a href="manageMyArticles.php">Manage My Articles</a><br>
<a href="viewArticles.php">View Articles</a><br>
<a href="logout.php">Logout</a>