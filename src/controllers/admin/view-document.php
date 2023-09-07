<?php

require_once('src/lib/db_connect.php');
require_once('src/models/admin/view-document.php');

use Application\Model\Admin\ViewDocument\ExtractData;

function receiveData()
{
    $datas = new ExtractData();
    $datas->connection = new DatabaseConnection();

    $documents = $datas->viewDoc();

    require('src/views/admin/view-document.php');
}