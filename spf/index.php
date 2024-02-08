<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPF private</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
$password = "SPF2023@ChTl"; 
if (isset($_POST['password']) && $_POST['password'] === $password) {
    $servername = " ";
    $username = " ";
    $password = " ";
    $dbname = " ";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die($conn->connect_error);
    }

    $sql = "SELECT * FROM messages";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='container'>";
        echo "<h2>Messages</h2>";
        echo "<table>";
        echo "<tr><th>Nom</th><th>Email</th><th>Message</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["message"]."</td><td>".$row["timestamp"]."</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "Aucun message trouvé.";
    }

    $conn->close();
} else {
    echo "<div class='container'>";
    echo "<h2>Connexion requise</h2>";
    echo "<form method='POST'>";
    echo "<label for='password'>Mot de passe :</label>";
    echo "<input type='password' id='password' name='password' required>";
    echo "<button type='submit'>Se connecter</button>";
    echo "</form>";
    echo "</div>";
}
?>

</body>
</html>
