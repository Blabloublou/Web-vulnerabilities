<?php
include("header.php");

$servername = "db";
$username = "root";
$password = "";
$dbname = "boxweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<h1>BruteForce Via Hydra</h1>

<form method="post">
    <label for="identifiant">Entrez un identifiant :</label>
    <input type="text" id="identifiant" name="identifiant" placeholder="Entrez un identifiant">
    <label for="password">Entrez un mot de passe :</label>
    <input type="text" id="password" name="password" placeholder="Entrez un mot de passe">
    <button type="submit">Envoyer</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['identifiant'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$id' AND password = '$password'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        die("Connexion réussie") ;
    } else {
        die("Échec de la connexion");
    }
}
?>

<?php
include("footer.php");
?>