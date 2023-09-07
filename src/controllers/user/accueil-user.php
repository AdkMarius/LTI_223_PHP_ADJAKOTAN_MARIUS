<?php

require_once ('src/lib/db_connect.php');
require_once ('src/models/user/accueil-user.php');

use Application\Model\User\ReceiveInfos;

function displayInfos()
{
    $connect = new ReceiveInfos();
    $connect->connection = new DatabaseConnection();

    $documents = $connect->receiveInfos();

    require ('src/views/user/accueil-user.php');
}

function searchInfos()
{
    $connect = new ReceiveInfos();
    $connect->connection = new DatabaseConnection();

    $documents = $connect->searchData($_POST);

    require ('src/views/user/accueil-user.php');
}