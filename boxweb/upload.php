<?php
include("header.php");
?>

<h1>Uploader un fichier</h1>
<form method="POST" enctype="multipart/form-data">
    <label>Sélectionner un fichier :</label><br>
    <input type="file" name="file"><br>
    <input type="submit" value="Uploader">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "Le fichier " . htmlspecialchars(basename($_FILES["file"]["name"])) . " a été uploadé.";
    } else {
        echo "Erreur lors de l'upload du fichier.";
    }
}

include("footer.php");
?>
