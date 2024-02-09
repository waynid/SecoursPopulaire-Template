<?php

$filePath = 'contacts.csv';

$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$message = str_replace('"', '\"', $message);

$line = implode(',', [
    '"' . $name . '"',
    '"' . $email . '"',
    '"' . $message . '"'
]) . PHP_EOL;

file_put_contents($filePath, $line, FILE_APPEND);
header("Location: valid.html");
?>
