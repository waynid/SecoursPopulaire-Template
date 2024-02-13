<?php
$pass = '$2a$05$bPvimse2QEj.n/ow6g.AXu9XWmv13lfBnEhOxNpLkyZpLj22KFDAC';

if (isset($_POST['mot_de_passe'])) {
    if (password_verify($_POST['mot_de_passe'], $pass)) {
        try {
            $db = new PDO('sqlite:private/spf.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if(isset($_POST['delete_id'])) {
                $deleteId = $_POST['delete_id'];
                $stmt = $db->prepare('DELETE FROM formulaire WHERE id = :id');
                $stmt->bindParam(':id', $deleteId);
                $stmt->execute();
            }

            $stmt = $db->query('SELECT * FROM formulaire');
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<div class=\"container\">";
            echo "<header style=\"text-align: center;\">";
            echo "<div class=\"logo\"><img src=\"img\Logo_Secours_populaire_français.png\" alt=\"Logo\"></div>";
            echo "<div class=\"title\"><h1>Derniers formulaires :</h1></div>";
            echo "</header>";
            echo "<div class=\"content\">";
            echo "<ul style=\"list-style-type: none; padding: 0; text-align: center;\">";
            foreach ($rows as $row) {
                echo "<li>Name: {$row['name']} | Email: {$row['email']} | Message: {$row['message']} | Time: {$row['time']} | <form method=\"post\" action=\"\"><input type=\"hidden\" name=\"mot_de_passe\" value=\"".$_POST['mot_de_passe']."\"><input type=\"hidden\" name=\"delete_id\" value=\"{$row['id']}\"><input type=\"submit\" value=\"Supprimer\"></form></li>";
                echo "<br>";
            }
            echo "</ul>";
            echo "</div>";
            echo "</div>";
        } catch (PDOException $e) {
            header('Location: error.html');
        }
    } else {
        header('Location: error.html');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaires | Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <?php if (!isset($_POST['mot_de_passe']) || !isset($rows)) : ?>
    <div class="container" style="text-align: center;">
        <header style="text-align: center;">
            <div class="logo"><img src="img\Logo_Secours_populaire_français.png" alt="Logo"></div>
            <div class="title"><h1>Formulaires | Dashboard</h1></div>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
        </header>
        <div class="content">
            <form class="contact-form" method="post" action="" style="text-align: center;">
                <label for="mot_de_passe">Mot de passe :</label><br>
                <input type="password" id="mot_de_passe" name="mot_de_passe"><br><br>
                <input type="submit" value="Valider" class="don-button">
            </form>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
