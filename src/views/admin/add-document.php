<?php

    $title = "Ajout des documents - Livres Numériques";
    $description = "Page dédié à l'administrateur pour l'ajout des documents !";
    $linkSecond = "rel='stylesheet' href='../../../assets/css/add-document.css'";
    $linkThird = "rel='stylesheet' href='../../../assets/css/top-navbar-admin.css'";
    $linkFourth = "rel='stylesheet' href='../../../assets/css/vertical-nav.css'";
    $script = "src='../../../assets/js/add-document.js' defer";
    $scriptFontAwesome = 'src="https://kit.fontawesome.com/0519f73e88.js" crossorigin="anonymous"';
?>

<?php ob_start() ?>
<?php require('../../../templates/top-navbar-admin.php'); ?>

<main class="main">
        <div class="main__sidebar">
            <?php require('../../../templates/vertical-nav.php'); ?>
        </div>
        <div class="main__content">
            <div class="main__content--child">
                <h1>Remplissez ce formulaire pour ajouter des documents !</h1>
                <form class="form" action="../../../index.php?action=addDoc" method="POST" enctype="multipart/form-data">
                    <div id="error"></div>
                    <div class="form__container">
                        <div class="form__field form__field--input">
                            <label for="title">Titre *</label>
                            <input type="text" name="title" id="title" required>
                        </div>
                        <div class="form__field form__field--input">
                            <label for="topic">Thème du Livre *</label>
                            <input type="text" name="topic" id="topic" required>
                        </div>
                    </div>

                    <div class="form__author" id="author--field">
                        <div class="form__container">
                            <div class="form__field form__field--input">
                                <label for="author">Auteurs</label>
                                <input type="text" name="authorName[]" class="authorName" id="authorName" placeholder="Nom *" required>
                            </div>
                            <div class="form__field form__field--input">
                                <input type="text" class="firstAuthorName" name="authorFirstName[]" id="authorFirstName" placeholder="Prénom(s)">
                            </div>
                        </div>
                    </div>

                    <div class="form__container">
                        <div class="form__field form__field--textarea">
                            <label for="summary">Résumé du Livre *</label>
                            <textarea name="summary" id="summary" cols="4" rows="8" required></textarea>
                        </div>
                    </div>

                    <div class="form__container">
                        <div class="form__field form__field--textarea">
                            <label for="keywords">Liste de mots clés *</label>
                            <textarea name="keywords" id="keywords" cols="0.5" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="form__container">
                        <div class="form__field form__field--textarea">
                            <label for="fileImage">Image de la première couverture *</label>
                            <input type="file" name="fileImage" id="fileImage" required>
                        </div>
                    </div>

                    <div class="form__container">
                        <div class="form__field form__field--textarea">
                            <label for="fileToUpload">Fichier *</label>
                            <input type="file" name="fileToUpload" id="fileToUpload" required>
                        </div>
                    </div>

                    <div class="form__container">
                        <div class="form__button">
                            <button type="submit" id="submitForm" class="btn btn-rounded btn-wide--full-width mg-button">Soumettre</button>
                        </div>
                        <div class="form__button">
                            <button type="button" id="addAuthor" class="btn btn-rounded btn-wide--full-width mg-button">Ajoutez plus d'auteurs</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('../layout.php') ?>
