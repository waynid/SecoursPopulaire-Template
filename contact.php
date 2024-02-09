<?php

$filePath = 'contacts.csv';

file_put_contents($filePath, implode(';', [
    $_POST['name'] ?? '',
    $_POST['email'] ?? '',
    $_POST['message'] ?? ''
]) . PHP_EOL, FILE_APPEND);

header("Location: valid.html");
?>
