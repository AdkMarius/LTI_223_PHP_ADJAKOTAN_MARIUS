<?php

require_once('src/lib/db_connect.php');
require_once('src/models/admin/admin-login.php');

use Application\Model\Admin\Login\AuthenticateAdmin;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateFormLogin(array $login)
{
    extract($login);
    if (!empty($email) && !empty($password))
    {
        $email = test_input($email);
        $password = test_input($password);

        $regexPassword = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/";
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match($regexPassword, $password))
        {
            $input = [
                'email' => $email,
                'password' => sha1($password)
            ];

            $authenticate = new AuthenticateAdmin();
            $authenticate->connection = new DatabaseConnection();
            $isOkay = $authenticate->authenticateAdmin($input);
            if ($isOkay['valid']) {
                header('Location: index.php?action=dashboard&identiferAdmin=' . urlencode($isOkay['arrayInfos']));
            }
            else
                throw new Exception('Authentification échoué !');
        }
        else
            throw new Exception("Les champs ne sont pas valides !");
    }
    else
        throw new Exception("Tous les champs doivent être renseignés !");
}