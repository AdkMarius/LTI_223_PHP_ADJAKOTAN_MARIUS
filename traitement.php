<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valeurs = $_POST["monChamp"];

    // $valeurs est maintenant un tableau contenant toutes les valeurs des champs monChamp
    foreach ($valeurs as $valeur) {
        echo "Valeur : " . htmlspecialchars($valeur) . "<br>";
    }

}
