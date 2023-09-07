<?php

namespace Application\Model\Admin\AddDocument;

require_once('src/lib/db_connect.php');

class PropertiesDocument
{
    public string $title;
    public string $topic;
    public array $authorName;
    public array $authorFirstName;
    public string $keywords;
    public string $summary;
    public string $pathFile;
    public string $fileImage;
}

class AddPropertiesDoc
{
    public \DatabaseConnection $connection;

    function insertDataDoc(array $input, string $id)
    {
        $isOkay = false;
        $propertiesDoc = new PropertiesDocument();

        $propertiesDoc->title = $input['title'];
        $propertiesDoc->topic = $input['topic'];
        $propertiesDoc->summary = $input['summary'];
        $propertiesDoc->keywords = $input['keywords'];
        $propertiesDoc->fileImage = $input['fileImage'];
        $propertiesDoc->pathFile = $input['fileToUpload'];

        $query = 'INSERT INTO documents(idUser, topicDoc, titleDoc, summaryDoc, keywords, pathImageDoc, pathDoc, dateInsertDoc) VALUES (:id, :topic, :title, :summary, :keywords, :pathImage, :pathFile, :dateInsert)';
        $statement = $this->connection->getConnection()->prepare($query);
        $isOkay = $statement->execute([
            "id" => $id,
            "topic" => $propertiesDoc->topic,
            "title" => $propertiesDoc->title,
            "summary" => $propertiesDoc->summary,
            "keywords" => $propertiesDoc->keywords,
            "pathImage" => $propertiesDoc->fileImage,
            "pathFile" => $propertiesDoc->pathFile,
            "dateInsert" => date('Y-m-d H:i:s')
        ]) or die(print_r($this->connection->getConnection()->errorInfo()));

        // get  the last id of document inserted
        $documentId = $this->connection->getConnection()->lastInsertId();

        if (!$isOkay)
            return false;

        foreach ($input['authorName'] as $item=>$value)
            $propertiesDoc->authorName[$item] = $value;

        foreach ($input['authorFirstName'] as $item=>$value)
            $propertiesDoc->authorFirstName[$item] = $value;

        $nbrNameAuthor = count($propertiesDoc->authorName);

        for ($i = 0; $i < $nbrNameAuthor; $i++)
        {
            $isOkay = false;

            $query = 'SELECT idAuthor FROM authors WHERE nameAuthor = :nameAuthor';
            $statement = $this->connection->getConnection()->prepare($query);
            $statement->execute([
                "nameAuthor" => $propertiesDoc->authorName[$i],
            ]) or die(print_r($this->connection->getConnection()->errorInfo()));

            $row = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (count($row) > 0)
            {
                //get idAuthor is Author exist
                $idAuthor = $row['idAuthor'];
            }
            else
            {
                $query = 'INSERT INTO authors (nameAuthor, firstName) VALUES (:nameAuthor, :firstName)';
                $statement = $this->connection->getConnection()->prepare($query);
                $statement->execute([
                    "nameAuthor" => $propertiesDoc->authorName[$i],
                    "firstName" => $propertiesDoc->authorFirstName[$i]
                ]) or die(print_r($this->connection->getConnection()->errorInfo()));

                // get idAuthor after insert author
                $idAuthor = $this->connection->getConnection()->lastInsertId();
            }

            $query = 'INSERT INTO documentsauthors(idDoc, idAuthor) VALUES (:idDoc, :idAuthor)';
            $statement = $this->connection->getConnection()->prepare($query);
            $statement->execute([
                "idDoc" => $documentId,
                "idAuthor" => $idAuthor
            ]);

            $isOkay = true;

            if (!$isOkay) break;
        }

        return ($isOkay);
    }
}