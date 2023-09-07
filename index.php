<?php

require_once('src/controllers/admin/admin-login.php');
require_once('src/controllers/admin/add-document.php');
require_once('src/controllers/admin/dashboard.php');
require_once('src/controllers/admin/view-document.php');
require_once('src/controllers/user/accueil-user.php');

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
        else if ($_GET['action'] == 'user' && isset($_GET['goal']))
        {
            if ($_GET['goal'] == 'search' && isset($_POST))
            {
                searchInfos();
            }
        }
        else if ($_GET['action'] == 'user' && !isset($_GET['goal']))
        {
            displayInfos();
        }
        else if ($_GET['action'] == 'delete' && isset($_GET['id']))
        {
            deleteInformation($_GET['id']);
        }
        else if ($_GET['action'] == 'update' && isset($_GET['id']))
        {
            redirect($_GET['id']);
        }
        else if ($_GET['action'] == 'updateRecord' && isset($_GET['id']))
        {
            if (isset($_POST))
            {
                updateRecord($_GET['id'], $_POST);
            }
        }
        else if ($_GET['action'] == 'logout')
        {
            logout();
        }
        else
            throw new Exception('Valeur pour action incorrecte !');
    }
    else
    {
        displayInfos();
    }
} catch (Exception $e) {
    echo 'Error : ' . $e->getMessage();
}