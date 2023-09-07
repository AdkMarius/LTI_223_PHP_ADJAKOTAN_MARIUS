<?php

//start section if is not exist
if (!isset($_SESSION))
    session_start();

require_once('src/models/admin/dashboard.php');

use Application\Model\Admin\Dashboard\ExtractInfoAdmin;

function setSessionUser(string $id)
{
    $isOkay = false;

    $infoAdmin = new ExtractInfoAdmin();
    $infoAdmin->connection = new DatabaseConnection();

    $identifierAdmin = $infoAdmin->extract($id);

    foreach ($identifierAdmin as $item)
    {
        if ($item)
        {
            extract($item);

            $_SESSION['idUser'] = $idUser;
            $_SESSION['emailUser'] = $email;
            $_SESSION['passwordUser'] = $password;

            $isOkay = true;
        }
    }

    if ($isOkay)
        header('Location: ./src/views/admin/dashboard.php');
}