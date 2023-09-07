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

function deleteInformation(string $identifier)
{
    echo 'deletedatainfo';

    $datas = new ExtractData();
    $datas->connection = new DatabaseConnection();

    if ($datas->deleteData($identifier))
    {
        header('Location: index.php?action=viewDoc');
    }
}

function redirect(string $id)
{
    $datas = new ExtractData();
    $datas->connection = new DatabaseConnection();

    $infosDoc = $datas->queryData($id);

    require ('src/views/admin/update-record.php');
}

function updateRecord(string $id, array $input)
{
    $datas = new ExtractData();
    $datas->connection = new DatabaseConnection();

    if (!empty($_FILES['fileToUpload']['name']) && !empty($_FILES['fileImage']))
    {
        if (validFile('fileToUpload', 1, 'update') && validFile('fileImage', 0, 'update'))
            $isOkay = $datas->updateData($id, $input, 'changeFile');
    }
    else
    {
        $isOkay = $datas->updateData($id, $input, 'none');
    }
    if ($isOkay)
        header('Location: index.php?action=viewDoc');
}