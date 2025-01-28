<?php
ob_start();
?>
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

$query = "SELECT validated FROM vulnerabilities WHERE id = 10";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$validated = $row['validated'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'Désactiver') {
        $sql = "UPDATE vulnerabilities SET validated = FALSE WHERE id = 10";
        if ($conn->query($sql) === TRUE) {
            $message = "Étape désactivée avec succès !";
            $alertType = "danger";
            $validated = false;
        } else {
            $message = "Erreur lors de la désactivation de l'étape.";
            $alertType = "danger";
        }
    } elseif ($action === 'Valider') {
        $sql = "UPDATE vulnerabilities SET validated = TRUE WHERE id = 10";
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

<form method="post">
    <input type="text" name="redirect" placeholder="Le lien">
    <button type="submit">Envoyer</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['redirect'];
    header("Location: " . $url);
    exit();
}
?>

<?php if ($validated): ?>
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
ob_end_flush();
?>
