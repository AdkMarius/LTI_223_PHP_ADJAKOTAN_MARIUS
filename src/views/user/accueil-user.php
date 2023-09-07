<?php

$title = 'Livres Numériques - Site de consulation de livres en ligne gratuit';
$description = 'Les livres sont importants pour se développer, nourrir son esprit critique et de créativité, et aussi
    développer sa carrière. Les livres peuvent vous changer de vie. C\'est pourquoi Livres Numériques vous propose
    des livres gratuits à télécharger !';

$linkFirst = 'rel="stylesheet" href="./assets/css/accueil-user.css"';
$script = 'src="./assets/js/accueil.js"';

?>

<?php ob_start() ?>
<?php require ('navbar-user.php') ?>

<div>
    <form method="POST" action="./index.php?action=user&goal=search" class="form">
        <div class="form__field">
            <input type="search" id="search" name="search" placeholder="Rechercher">
            <button type="submit" class="btn btn-rounded btn-medium" >Rechercher</button>
        </div>
    </form>
</div>

<div class="container-custom">
    <div class="custom-row">
        <?php foreach ($documents as $document) : ?>
            <div class="custom-col-4">
                    <div class="custom-card">
                        <div>
                            <img class="custom-card-img" src="<?= './uploads/' . basename($document['pathImageDoc']) ?>" alt="<?= $document['titleDoc'] ?>">
                        </div>
                        <div class="custom-card-title">
                            <h2><?= $document['titleDoc'] ?></h2>
                        </div>
                    </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php $content = ob_get_clean() ?>
<?php require ('src/views/layout.php');
