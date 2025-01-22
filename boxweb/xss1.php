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

// Récupérer l'état de "validated" de la table "vulnerabilities"
$query = "SELECT validated FROM vulnerabilities WHERE id = 1";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$message = "";
$alertType = "";
$validated = $row['validated'];  // État de validated

// Traiter la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'Désactiver') {
        $sql = "UPDATE vulnerabilities SET validated = FALSE WHERE id = 1";
        if ($conn->query($sql) === TRUE) {
            $message = "Étape désactivée avec succès !";
            $alertType = "danger";
            $validated = false;
        } else {
            $message = "Erreur lors de la désactivation de l'étape.";
            $alertType = "danger";
        }
    } elseif ($action === 'Valider') {
        $sql = "UPDATE vulnerabilities SET validated = TRUE WHERE id = 1";
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

<h1>Gestion de l'étape de vulnérabilité</h1>

<ul>
    <li><a href="index.php">Accueil</a></li>
    <li><a href="login.php">Connexion</a></li>
    <li><a href="comment.php">Commentaires</a></li>
    <li><a href="upload.php">Uploader un fichier</a></li>
</ul>

<?php if ($validated): ?>
    <form method="POST">
        <input type="submit" name="action" value="Désactiver">
    </form>
<?php else: ?>
    <form method="POST">
        <input type="submit" name="action" value="Valider">
    </form>
<?php endif; ?>

<?php
$conn->close();
include("./footer.php");
?>