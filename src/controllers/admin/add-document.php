<?php

if (!isset($_SESSION))
    session_start();

require_once('src/lib/db_connect.php');
require_once('src/models/admin/add-document.php');

use Application\Model\Admin\AddDocument\AddPropertiesDoc;

$pathFile = [];

function validFile(string $nameOfFile, int $value, string $chaine) : bool
{
    global $pathFile;

    if (isset($_FILES[$nameOfFile]) && $_FILES[$nameOfFile]['error'] == 0) {

        $target_dir = 'C:\xampp\htdocs\workspace-php\LTI_223_PHP_ADJAKOTAN_MARIUS\uploads/';
        $target_file = $target_dir . basename($_FILES[$nameOfFile]['name']);
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if ($chaine == 'add')
        {
            if (file_exists($target_file)) {
                $uploadOk = 0;
                throw new Exception("Sorry, file already exists.");
            }
        }

        // Check file size and format
        if ($value) {
            // Here, the file is a document
            if ($_FILES[$nameOfFile]["size"] > 100000000) {
                $uploadOk = 0;
                throw new Exception("Sorry, your file is too large.");
            }

            // Allow only pdf format
            if ($imageFileType != "pdf") {
                $uploadOk = 0;
                throw new Exception("Sorry, only PDF is allowed.");
            }
        } else {
            // The file is an image
            if ($_FILES[$nameOfFile]["size"] > 2000000) {
                $uploadOk = 0;
                throw new Exception("Sorry, your image is too large.");
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp") {
                $uploadOk = 0;
                throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES[$nameOfFile]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
                throw new Exception("File is not an image.");
            }
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            throw new Exception("Sorry, your file was not uploaded.");
        } else {
            array_push($pathFile, $target_file);

            return (move_uploaded_file($_FILES[$nameOfFile]["tmp_name"], $target_file));
        }
    }

    return (false);
}
function validateFormDoc()
{
    $valid = 0;
    global $pathFile;

    $infoDocument = [];
    foreach ($_POST as $item => $value) {
        if (is_array($_POST[$item])) {
            foreach ($_POST[$item] as $itemAuthor => $valueAuthor) {
                $infoDocument[$item][$itemAuthor] = test_input($valueAuthor);
            }
        } else
            $infoDocument[$item] = test_input($value);
    }

    if (validFile('fileToUpload', 1, 'add') && validFile('fileImage', 0, 'add'))
        $valid = 1;

    if ($valid) {
        $addPropertiesDoc = new AddPropertiesDoc();
        $addPropertiesDoc->connection = new DatabaseConnection();

        $infoDocument['fileToUpload'] = $pathFile[0];
        $infoDocument['fileImage'] = $pathFile[1];
        var_dump($infoDocument);
        $isOkay = $addPropertiesDoc->insertDataDoc($infoDocument, $_SESSION['idUser']);

        if ($isOkay) {
            header('Location: index.php?action=viewDoc');
        }
    }
}

function logout()
{
    session_unset();

    session_destroy();

    header('Location: src/views/admin/admin-login.php');
}