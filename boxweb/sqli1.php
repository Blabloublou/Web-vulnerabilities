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

$query = "SELECT validated FROM vulnerabilities WHERE id = 8";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$message = "";
$alertType = "";
$validated = $row['validated'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'Désactiver') {
        $sql = "UPDATE vulnerabilities SET validated = FALSE WHERE id = 8";
        if ($conn->query($sql) === TRUE) {
            $message = "Étape désactivée avec succès !";
            $alertType = "danger";
            $validated = false;
        } else {
            $message = "Erreur lors de la désactivation de l'étape.";
            $alertType = "danger";
        }
    } elseif ($action === 'Valider') {
        $sql = "UPDATE vulnerabilities SET validated = TRUE WHERE id = 8";
        if ($conn->query($sql) === TRUE) {
            $message = "Étape validée avec succès !";
            $alertType = "success";
            $validated = true;
        } else {
            $message = "Erreur lors de la validation de l'étape.";
            $alertType = "danger";
        }
    }
}

?>

<?php if (!empty($message)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertContainer = document.getElementById('alert-container');
            const alert = document.createElement('div');
            alert.className = 'alert alert-<?= $alertType ?> alert-dismissible fade show';
            alert.setAttribute('role', 'alert');
            alert.innerHTML = `
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            alertContainer.appendChild(alert);

            setTimeout(() => {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 150);
            }, 5000);
        });
    </script>
<?php endif; ?>

<h1>Injection basique via $_POST</h1>

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
        while ($row = $result->fetch_assoc()) {
            echo "<span style='background-color: #ffffff; padding: 8px; border-radius: 8px; color: black;'>Nom : " . $row['username'] . "<br></span>";
        }
    } else {
        echo "<span style='background-color: #ffffff; padding: 8px; border-radius: 8px; color: black;'>Aucun utilisateur trouvé.</span>";
    }
}


if ($validated): ?>
<div style="position: fixed; bottom: 32px; right: 32px; max-width: 30%;">
    <form method="POST" style="padding: 16px;">
        <button type="submit" name="action" value="Désactiver" class="btn btn-danger">Désactiver</button>
    </form>
</div>
<?php else: ?>
<div style="position: fixed; bottom: 32px; right: 32px; max-width: 30%;">
    <form method="POST" style="padding: 16px;">
        <button type="submit" name="action" value="Valider" class="btn btn-success">Valider</button>
    </form>
</div>

<?php endif; ?>

<?php
$conn->close();
include("./footer.php");
?>
