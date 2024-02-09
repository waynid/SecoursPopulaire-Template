<?php

$filePath = 'contacts.csv';

$message = isset($_POST['message']) ? $_POST['message'] : '';
$message = str_replace('"', '\"', $message);

file_put_contents($filePath, implode(',', [
    $_POST['name'] ?? '',
    $_POST['email'] ?? '',
    '"' . $message . '"' 
]) . PHP_EOL, FILE_APPEND);

header("Location: valid.html");
?>
