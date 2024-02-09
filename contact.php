<?php

$filePath = 'contacts.json';

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

$newData = array(
    'name' => $name,
    'email' => $email,
    'message' => $message
);

$existingData = file_get_contents($filePath);
$existingDataArray = json_decode($existingData, true);

$existingDataArray[] = $newData;

$newJsonData = json_encode($existingDataArray, JSON_PRETTY_PRINT);

file_put_contents($filePath, $newJsonData);

header("Location: valid.html"); 
exit()
?>
