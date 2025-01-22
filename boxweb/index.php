<?php
include("header.php");
?>

<div class="main-container">
    <h1>Bienvenue sur notre site vulnérable</h1>
    <div class="index_main-grid">

        <div class="index_card">
            <div class="index_card-body">
                <h5 class="index_card-title">SQL Injection</h5>
                <a href="sqli.php" class="index_btn-custom">Voir plus</a>
            </div>
        </div>

        <div class="index_card">
            <div class="index_card-body">
                <h5 class="index_card-title">Cross-Site Scripting (XSS)</h5>
                <a href="xss.php" class="index_btn-custom">Voir plus</a>
            </div>
        </div>

        <div class="index_card">
            <div class="index_card-body">
                <h5 class="index_card-title">CSRF</h5>
                <a href="csrf.php" class="index_btn-custom">Voir plus</a>
            </div>
        </div>

        <div class="index_card">
            <div class="index_card-body">
                <h5 class="index_card-title">Remote File Inclusion (RFI)</h5>
                <a href="rfi.php" class="index_btn-custom">Voir plus</a>
            </div>
        </div>

        <div class="index_card">
            <div class="index_card-body">
                <h5 class="index_card-title">Local File Inclusion (LFI)</h5>
                <a href="lfi.php" class="index_btn-custom">Voir plus</a>
            </div>
        </div>

        <div class="index_card">
            <div class="index_card-body">
                <h5 class="index_card-title">XXE</h5>
                <a href="xxe.php" class="index_btn-custom">Voir plus</a>
            </div>
        </div>

        <div class="index_card index_last-item">
            <div class="index_card-body">
                <h5 class="index_card-title">Open Redirect</h5>
                <a href="open_redirect.php" class="index_btn-custom">Voir plus</a>
            </div>
        </div>

    </div>
</div>


<?php
include("footer.php");
?>