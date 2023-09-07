<?php

if (!isset($_SESSION))
    session_start();

    $title = 'Page d\'administration du site - Livres Numériques';
    $description = 'Espace d\'administration du site Livres Numériques, dédié aux admins';
    $linkSecond = "rel='stylesheet' href='../../../assets/css/top-navbar-admin.css'";
    $linkThird = "rel='stylesheet' href='../../../assets/css/vertical-nav.css'";
    $linkFourth = "rel='stylesheet' href='../../../assets/css/dashboard.css'";
    $scriptFontAwesome = 'src="https://kit.fontawesome.com/0519f73e88.js" crossorigin="anonymous"';
    $script = "src='../../../assets/js/dashboard.js' defer";
?>

<?php ob_start(); ?>
<?php require('../../../templates/top-navbar-admin.php'); ?>

<main class="main">
    <div class="main__sidebar">
        <?php require('../../../templates/vertical-nav.php'); ?>
    </div>

    <div class="main__content">
        <div class="main__content--child">
            <h1>Bonjour et bienvenue sur le tableau de bord du site Livres Numériques !</h1>
            <div style="margin: 20px 0;">
                <p>
                    Livres Numériques est une banque documentaire qui donne la possibilité aux utilisateurs de consulter des livres et les télécharger selon leurs besoins. En tant qu'administrateur,
                    vous serez amener à ajouter des documents, à les modifier selon le besoin et à les supprimer. Let's go !
                </p>

                <div class="container text-center" id="main-container">

                </div>
            </div>
        </div>
    </div>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>