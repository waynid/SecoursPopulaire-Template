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
        if (strlen($nom) > 50) {
            echo "<script>alert('Limite de caractères dépassée pour le champ Nom.');</script>";
        } elseif (strlen($email) > 50) {
            echo "<script>alert('Limite de caractères dépassée pour le champ Email.');</script>";
        } elseif (strlen($message) > 300) {
            echo "<script>alert('Limite de caractères dépassée pour le champ Message.');</script>";
        } else {
            $stmt->execute(array(
                ':id' => $newId,
                ':name' => $nom,
                ':email' => $email,
                ':message' => $message,
                ':time' => $time
            ));
            header('Location: valid.html');
        }
    } catch (PDOException $e) {
        header('Location: error.html');
    }
    

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPF Châteaulin | Contact</title>
    <meta name="description" content="Le Secours Populaire Français de Châteaulin est une association humanitaire œuvrant pour la solidarité et l'aide aux plus démunis. Découvrez nos actions, nos projets et comment vous pouvez contribuer à notre cause.">
    <meta name="keywords" content="Secours Populaire, association, humanitaire, solidarité, aide, démunis, Châteaulin, bénévolat, dons, soutien, communauté, aide alimentaire, aide sociale, lutte contre la précarité, solidarité internationale, actions sociales">
    <link rel="icon" type="image/png" href="img/Logo_Secours_populaire_français.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="css.css">
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <img src="img/Logo_Secours_populaire_français.png" alt="Logo SPF">
        </div>
        <div class="title">
            <h1>Secours Populaire Français | Chateaulin</h1>
            <br>
            <a href="brocante.html" class="don-button">brocante</a>
            <a href="braderie.html" class="don-button">Braderie</a>
            <a href="https://don.secourspopulaire.fr/defaut/~mon-don?_cv=1" class="don-button">Faire un don</a>
            <a href="index.html" class="don-button">Accueil</a>
        </div>
    </div>
</header>

<section class="contact-form">
    <div class="container">
        <h2>Contactez-nous</h2>
        <form action="contact.php" method="POST">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Message :</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>

</body>
</html>

