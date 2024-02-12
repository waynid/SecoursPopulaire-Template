<?php
$dbFile = 'private/spf.db';

try {
    $db = new PDO('sqlite:' . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    $time = date('Y-m-d H:i:s');

    $stmt = $db->prepare("INSERT INTO formulaire (name, email, message, time) VALUES (:name, :email, :message, :time)");

    try {
        $stmt->execute(array(
            ':name' => $nom,
            ':email' => $email,
            ':message' => $message,
            ':time' => $time
        ));
        header('Location: valid.html');
    } catch (PDOException $e) {
        header('Location: error.html');
    }
}
?>
