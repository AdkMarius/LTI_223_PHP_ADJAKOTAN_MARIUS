<?php

require_once('src/controllers/admin/admin-login.php');
require_once('src/controllers/admin/add-document.php');
require_once('src/controllers/admin/dashboard.php');
require_once('src/controllers/admin/view-document.php');

try {
    if (!empty($_GET['action']))
    {
        if ($_GET['action'] == 'login')
        {
            if(isset($_POST['email']) && isset($_POST['password']))
            {
                validateFormLogin($_POST);
            }
            else
                throw new Exception('Aucun identifiant envoyé !');
        }
        else if ($_GET['action'] == 'addDoc' && isset($_FILES))
        {
            $isEmpty = 0;
            foreach ($_POST as $item)
            {
                if(empty($item))
                    $isEmpty = 1;
                else continue;
            }

            if (!$isEmpty)
                validateFormDoc();
        }
        else if ($_GET['action'] == 'dashboard' && isset($_GET['identiferAdmin']))
        {
            setSessionUser($_GET['identiferAdmin']);
        }
        else if ($_GET['action'] == 'viewDoc')
        {
            receiveData();
        }
        else
            throw new Exception('Valeur pour action incorrecte !');
    }
    else
        throw new Exception('Je dois inclure le fichier par défaut vers l\'accuiel de user');
} catch (Exception $e) {
    echo 'Error : ' . $e->getMessage();
}