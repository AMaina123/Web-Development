<?php
require 'constant.php';

$result = $mysqli->query("SELECT * FROM articles WHERE article_display='yes' ORDER BY article_created_date DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LegalGuide | View Articles</title>
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
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    .article {
      margin-bottom: 30px;
      border-bottom: 1px solid #eee;
      padding-bottom: 20px;
    }

    .article h3 {
      margin: 0;
      color: #2c3e50;
    }

    .article-date {
      font-size: 12px;
      color: #888;
      margin-bottom: 10px;
    }

    .article p {
      font-size: 14px;
      color: #333;
      line-height: 1.6;
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
    <h2>Latest Articles</h2>

    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="article">
        <h3><?= htmlspecialchars($row['article_title']) ?></h3>
        <div class="article-date"><?= htmlspecialchars($row['article_created_date']) ?></div>
        <p><?= nl2br(htmlspecialchars($row['article_full_text'])) ?></p>
      </div>
    <?php endwhile; ?>


    <div class="footer-note">© Authorship 2025. All rights reserved.</div>
  </div>
</body>
</html>