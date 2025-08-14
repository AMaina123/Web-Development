<?php
require 'constant.php';

$result = $mysqli->query("SELECT * FROM articles WHERE article_display='yes' ORDER BY article_created_date DESC LIMIT 6");
while ($row = $result->fetch_assoc()) {
    echo "<h3>{$row['article_title']}</h3><p>{$row['article_full_text']}</p><hr>";
}
?>