<?php
// This script generates password hashes for different user types.
echo "SuperUser: " . password_hash('superuser', PASSWORD_DEFAULT) . "\n";
echo "Administrator: " . password_hash('administrator', PASSWORD_DEFAULT) . "\n";
echo "Author: " . password_hash('author', PASSWORD_DEFAULT) . "\n";
?>
