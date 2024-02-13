<?php
$dbFile = 'private/spf.db';

try {
    $db = new PDO('sqlite:' . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
    $message = isset($_POST['message']) ? filter_var($_POST['message'], FILTER_SANITIZE_STRING) : '';
    $time = date('Y-m-d H:i:s');

    $stmt = $db->query("SELECT MAX(id) FROM formulaire");
    $lastId = $stmt->fetchColumn();
    $newId = $lastId + 1;

    $stmt = $db->prepare("INSERT INTO formulaire (id, name, email, message, time) VALUES (:id, :name, :email, :message, :time)");

    try {
        $stmt->execute(array(
            ':id' => $newId,
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
