<!-- header.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Vulnérable</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (optionnel, pour les composants interactifs comme modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body style="background-color: gray;">
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sqli.php">SQLI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="comment.php">XSS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="upload.php" tabindex="-1" aria-disabled="true">Désactivé</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <nav>
    </nav>
</header>
<main style="position: relative; display: flex; flex-direction: column; gap: 24px;color: #fff; justify-content: center; align-items: center; height: 100%;">
    <div id="alert-container" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>

