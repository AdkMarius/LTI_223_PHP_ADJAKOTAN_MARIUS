<?php

if (!isset($_SESSION))
    session_start();

    $title = "Voir les documents - Livres Numériques";
    $description = "Page de consultation des livres numériques par l'administrateur";
    $linkFirst = "rel='stylesheet' href='./assets/css/view-document.css'";
    $linkSecond = "rel='stylesheet' href='./assets/css/top-navbar-admin.css'";
    $linkThird = "rel='stylesheet' href='./assets/css/vertical-nav.css'";
    $script = "src='./assets/js/view-document.js' defer";
    $scriptFontAwesome = 'src="https://kit.fontawesome.com/0519f73e88.js" crossorigin="anonymous"';

    require_once ('src/controllers/admin/view-document.php');
?>


<?php ob_start() ?>
<?php require('templates/top-navbar-admin.php'); ?>

<main class="main">
    <div class="main__sidebar">
        <?php require('templates/vertical-nav.php'); ?>
    </div>

    <div class="main__content">
        <div class="main__content--child">
            <h1>Consultez ici la liste de tous les livres numériques</h1>

            <div class="main__table">
                <table class="table">
                    <tr>
                        <th>Nombre</th>
                        <th>Thèmes</th>
                        <th>Titre</th>
                        <th>Résumé du Livre</th>
                        <th>Auteurs</th>
                        <th>Mots Clés</th>
                        <th>Date d'Insertion</th>
                    </tr>

                    <?php
                        $i = 1;
                        foreach ($documents as $document) :
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <?php foreach ($document as $col) : ?>
                            <td><?= $col ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php
                        $i++;
                        endforeach;
                    ?>

                </table>
            </div>
        </div>
    </div>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
