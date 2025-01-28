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

$query = "SELECT validated FROM vulnerabilities WHERE id = 7";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$validated = $row['validated'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'Désactiver') {
        $sql = "UPDATE vulnerabilities SET validated = FALSE WHERE id = 7";
        if ($conn->query($sql) === TRUE) {
            $message = "Étape désactivée avec succès !";
            $alertType = "danger";
            $validated = false;
        } else {
            $message = "Erreur lors de la désactivation de l'étape.";
            $alertType = "danger";
        }
    } elseif ($action === 'Valider') {
        $sql = "UPDATE vulnerabilities SET validated = TRUE WHERE id = 7";
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

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" id="fileInput" required>
    <button type="submit">Envoyer</button>
</form>
<?php

$uploadDir = 'uploads/';

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];

    $allowedExtensions = ['png', 'jpeg', 'jpg', 'gif'];
    $fileNameLower = strtolower($fileName);

    foreach ($allowedExtensions as $ext) {
        if (strpos($fileNameLower, $ext) !== false) {
            $destination = $uploadDir . basename($fileName);

            if (move_uploaded_file($fileTmpName, $destination)) {
                echo "Fichier téléchargé avec succès : <a href='$destination'>$fileName</a>";
            } else {
                echo "Erreur lors de l'upload du fichier.";
            }
            break;
        }
    }

    if (!isset($destination)) {
        echo "Le fichier doit contenir l'une des extensions suivantes dans son nom : 'png', 'jpeg', 'jpg', 'gif'.";
    }
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
?>
