<?php

if (!isset($_SESSION))
    session_start();

    $title = "Voir les documents - Livres Numériques";
    $description = "Page de consultation des livres numériques par l'administrateur";
    $linkFirst = "rel='stylesheet' href='./assets/css/view-document.css'";
    $linkSecond = "rel='stylesheet' href='./assets/css/top-navbar-admin.css'";
    $linkThird = "rel='stylesheet' href='./assets/css/vertical-nav.css'";
    $scriptFontAwesome = 'src="https://kit.fontawesome.com/0519f73e88.js" crossorigin="anonymous"';
    $script = 'src=./assets/js/view-document.js';

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
                <table class="table--custom">
                    <tr>
                        <th>Nombre</th>
                        <th>ID</th>
                        <th>Thèmes</th>
                        <th>Titre</th>
                        <th>Résumé du Livre</th>
                        <th>Auteurs</th>
                        <th>Mots Clés</th>
                        <th>Date d'Insertion</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>

                    <?php
                        $i = 1;
                        foreach ($documents as $document) :
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <?php foreach ($document as $col) : ?>
                            <td class="row-custom"><?= $col ?></td>
                        <?php endforeach; ?>
                        <td>
                            <a id="update" href="./index.php?action=update&id=<?= urlencode($document['idDoc']) ?>">Modifier</a>
                        </td>
                        <td>
                            <a id="delete" href="./index.php?action=delete&id=<?= urlencode($document['idDoc']) ?>">Supprimer</a>
                        </td>
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

<?php require('./src/views/layout.php') ?>
