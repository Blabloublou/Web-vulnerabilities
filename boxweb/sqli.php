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

$query = "SELECT COUNT(*) AS total, SUM(validated) AS validated_count 
          FROM vulnerabilities 
          WHERE defi = 'sqli'";
$result = $conn->query($query);
if (!$result) {
    die("Erreur lors de la requête pour la progression: " . $conn->error);
}
$row = $result->fetch_assoc();

$totalSteps = $row['total'];
$validatedSteps = $row['validated_count'];
$progressPercentage = ($totalSteps > 0) ? ($validatedSteps / $totalSteps) * 100 : 0;

$query = "SELECT id, validated, defi FROM vulnerabilities WHERE defi = 'sqli'";
$cardsResult = $conn->query($query);
if (!$cardsResult) {
    die("Erreur lors de la requête pour les cartes: " . $conn->error);
}

$cards = [];
if ($cardsResult->num_rows > 0) {
    while ($row = $cardsResult->fetch_assoc()) {
        $cards[] = $row;
    }
}
?>

<div class="container">
    <h1 class="h1">Failles SQLI</h1>

    <div class="progress bar-lenght">
        <div
                class="progress-bar"
                role="progressbar"
                aria-valuenow=""
                aria-valuemin="0"
                aria-valuemax="100"
                style="width: <?= $progressPercentage ?>%;">
            <?= round($progressPercentage) ?>%
        </div>
    </div>
</div>

<div class="cards-container">
    <?php foreach ($cards as $card): ?>
        <div class="card">
            <a href="sqli<?= $card['id'] - 11 ?>.php">SLQI <?= $card['id'] - 11 ?></a>
            <?php if ($card['validated']): ?>
                <span>
                    Validé
                </span>
            <?php else: ?>
                <span>
                    Non validé
                </span>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<?php
$conn->close();
include("footer.php");
?>
