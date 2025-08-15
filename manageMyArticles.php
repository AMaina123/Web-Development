<?php
session_start();
require 'constant.php';

if ($_SESSION['user']['UserType'] !== 'Author') {
    header("Location: index.php");
    exit;
}

$authorId = $_SESSION['user']['userId'];
$addMessage = '';

// Add Article
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['article_title'];
    $text = $_POST['article_full_text'];
    $display = $_POST['article_display'];
    $order = $_POST['article_order'];

    $stmt = $mysqli->prepare("INSERT INTO articles (authorId, article_title, article_full_text, article_display, article_order) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $authorId, $title, $text, $display, $order);
    $stmt->execute();

    $addMessage = "✅ Article added successfully.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LegalGuide | Manage Articles</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      padding: 40px;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    form input, form textarea, form select {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    form button {
      width: 100%;
      padding: 12px;
      background-color: #2c3e50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    form button:hover {
      background-color: #34495e;
    }

    .message {
      text-align: center;
      margin-bottom: 15px;
      color: green;
      font-size: 14px;
    }

    .article-list {
      margin-top: 30px;
    }

    .article-item {
      padding: 15px;
      border-bottom: 1px solid #eee;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .article-title {
      font-weight: bold;
      color: #2c3e50;
    }

    .article-date {
      font-size: 12px;
      color: #888;
    }

    .article-actions a {
      margin-left: 10px;
      text-decoration: none;
      color: #2980b9;
      font-size: 14px;
    }

    .article-actions a:hover {
      text-decoration: underline;
    }

    .footer-note {
      text-align: center;
      margin-top: 40px;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Manage Your Articles</h2>

    <?php if ($addMessage): ?>
      <div class="message"><?= $addMessage ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Article Title</label>
      <input name="article_title" placeholder="Title" required>
        <label>Article Content</label>
      <textarea name="article_full_text" placeholder="Content" rows="5" required></textarea>
        <label>Display Article</label>
      <select name="article_display">
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select>
        <label>Article Order</label>
      <input name="article_order" type="number" placeholder="Order" required>
      <button type="submit">Add Article</button>
    </form>

    <div class="article-list">
      <?php
      $result = $mysqli->query("SELECT * FROM articles WHERE authorId=$authorId ORDER BY article_order ASC");
      while ($row = $result->fetch_assoc()):
      ?>
        <div class="article-item">
          <div>
            <div class="article-title"><?= htmlspecialchars($row['article_title']) ?></div>
            <div class="article-date"><?= htmlspecialchars($row['article_created_date']) ?></div>
          </div>
          <div class="article-actions">
            <a href="edit_article.php?id=<?= $row['articleId'] ?>">Edit</a>
            <a href="delete_article.php?id=<?= $row['articleId'] ?>">Delete</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <!-- Back to Dashboard Button -->
<div style="text-align: center; margin-top: 30px;">
  <a href="Author.php" style="
    display: inline-block;
    padding: 10px 20px;
    background-color: #27ae60;
    color: white;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.2s ease;
  "> Back to Dashboard</a>
</div>

    <div class="footer-note">© LegalGuide 2025. All rights reserved.</div>
  </div>
</body>
</html>