<?php
include("header.php");
?>

    <h1>Connexion</h1>
    <form method="POST">
        <label>Nom d'utilisateur :</label><br>
        <input type="text" name="username"><br>
        <label>Mot de passe :</label><br>
        <input type="password" name="password"><br>
        <input type="submit" value="Se connecter">
    </form>

<?php

include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        echo "Bienvenue, $username !";
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

include("footer.php");
?>