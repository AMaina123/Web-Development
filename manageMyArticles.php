<?php
session_start();
require 'constant.php';

if ($_SESSION['user']['UserType'] !== 'Author') {
    header("Location: index.php");
    exit;
}

$authorId = $_SESSION['user']['userId'];

// Add Article
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['article_title'];
    $text = $_POST['article_full_text'];
    $display = $_POST['article_display'];
    $order = $_POST['article_order'];

    $stmt = $mysqli->prepare("INSERT INTO articles (authorId, article_title, article_full_text, article_display, article_order) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $authorId, $title, $text, $display, $order);
    $stmt->execute();
    echo "Article added.";
}

// List Articles
$result = $mysqli->query("SELECT * FROM articles WHERE authorId=$authorId");
while ($row = $result->fetch_assoc()) {
    echo "{$row['article_title']} - {$row['article_created_date']} 
    <a href='edit_article.php?id={$row['articleId']}'>Edit</a> 
    <a href='delete_article.php?id={$row['articleId']}'>Delete</a><br>";
}
?>

<form method="POST">
    <input name="article_title" placeholder="Title" required><br>
    <textarea name="article_full_text" placeholder="Content" required></textarea><br>
    <select name="article_display">
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select><br>
    <input name="article_order" type="number" placeholder="Order" required><br>
    <button type="submit">Add Article</button>
</form>