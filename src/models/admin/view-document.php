<?php

namespace Application\Model\Admin\ViewDocument;

require_once ('src/lib/db_connect.php');

class ExtractData {
    public \DatabaseConnection $connection;

    public function viewDoc ()
    {
        $query = 'SELECT d.idDoc, d.topicDoc, d.titleDoc, SUBSTRING(d.summaryDoc, 1, 100) AS summaryDoc, CONCAT(a.firstName, a.nameAuthor) AS infosAuthor, d.keywords, d.dateInsertDoc
                  FROM documents AS d
                  JOIN documentsauthors AS da
                  ON d.idDoc = da.idDoc
                  JOIN authors AS a 
                  ON da.idAuthor = a.idAuthor
                  GROUP BY d.idDoc';

        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute();
        $infosDoc = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return ($infosDoc);
    }

    public function deleteFileFromServer(string $id)
    {
        $isDelete = 0;

        $query = 'SELECT pathImageDoc, pathDoc FROM documents WHERE idDoc = :id';
        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);

        $path = $statement->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($path as $item)
        {
            if (file_exists('./uploads/' . basename($item['pathImageDoc'])))
            {
                $isDelete = 0;

                unlink($item['pathImageDoc']);
                $isDelete = 1;
            }
            else
                $isDelete = 1;

            if (file_exists('./uploads/' . basename($item['pathDoc'])))
            {
                $isDelete = 0;

                unlink($item['pathDoc']);
                $isDelete = 1;
            }
            else
                $isDelete = 1;
        }

        return ($isDelete);
    }

    public function deleteData(string $id)
    {
        $isDelete = 0;

        $isDelete = $this->deleteFileFromServer($id);
        if ($isDelete)
        {
            $query = 'DELETE FROM documentsauthors WHERE idDoc = :id';
            $statement = $this->connection->getConnection()->prepare($query);
            $statement->execute([
                'id' => $id
            ]);

            $isDelete = 1;

            if ($isDelete) {

                $isDelete = 0;

                $query = 'DELETE FROM documents WHERE idDoc = :id';

                $statement = $this->connection->getConnection()->prepare($query);
                $statement->execute([
                    'id' => $id
                ]);
            }

            $query = 'DELETE FROM authors WHERE idAuthor NOT IN (SELECT idAuthor FROM documentsauthors)';

            $statement = $this->connection->getConnection()->prepare($query);
            $statement->execute();

            $isDelete = 1;
        }

        return ($isDelete);
    }

    public function queryData(string $id)
    {
        $query = 'SELECT d.idDoc, d.topicDoc, d.titleDoc, d.summaryDoc, a.nameAuthor, a.firstName, d.keywords
                  FROM documents AS d
                  JOIN documentsauthors AS da
                  ON d.idDoc = da.idDoc
                  JOIN authors AS a 
                  ON da.idAuthor = a.idAuthor
                  WHERE d.idDoc = :id';

        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
        $infosDoc = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return ($infosDoc);
    }

    public function updateData(string $id, array $input, string $sent)
    {
        $isOkay = false;
        $isDelete = false;

        if ($sent == 'changeFile') {
            $isDelete = true;
            $idDelete = $this->deleteFileFromServer($id);

            if ($idDelete) {
                $query = 'UPDATE documents
                        SET titleDoc = :title, topicDoc = :topic, keywords = :keywords, summaryDoc = :summary, 
                            pathImageDoc = :pathImage, pathDoc = :pathDoc, dateInsertDoc = :date
                            WHERE idDoc = :id';
                $statement = $this->connection->getConnection()->prepare($query);
                $isOkay = $statement->execute([
                    'title' => $input['title'],
                    'topic' => $input['topic'],
                    'keywords' => $input['keywords'],
                    'summary' => $input['summary'],
                    'pathImage' => $_FILES['fileImage'][''],
                    'pathDoc' => $_FILES['fileToUpload'],
                    'date' => date('Y-m-d H:i:s')
                ]);
            }
        } else {
                echo 'aaaaaaaaaaaaa';
                var_dump($input);
                $query = 'UPDATE documents
                    SET titleDoc = :title, topicDoc = :topic, keywords = :keywords, summaryDoc = :summary, dateInsertDoc = :date
                        WHERE idDoc = :id';
                $statement = $this->connection->getConnection()->prepare($query);
                $isOkay = $statement->execute([
                    'title' => $input['title'],
                    'topic' => $input['topic'],
                    'keywords' => $input['keywords'],
                    'summary' => $input['summary'],
                    'date' => date('Y-m-d H:i:s'),
                    'id' => $id
                ]);
        }

        echo 'bbbbbbbbbbbbb';

        if ($isOkay) {

            $nbrNameAuthor = count($input['authorName']);

            for ($i = 0; $i < $nbrNameAuthor; $i++) {
                $isOkay = false;


                $query = 'UPDATE authors AS a
                            JOIN documentsauthors AS da
                            ON a.idAuthor = da.idAuthor
                            JOIN documents AS d
                            ON da.idDoc = d.idDoc
                            SET a.nameAuthor = :name, a.firstName = :firstName
                            WHERE d.idDoc = :id';

                $statement = $this->connection->getConnection()->prepare($query);
                $isOkay = $statement->execute([
                    "name" => $input['authorName'][$i],
                    "firstName" => $input['authorFirstName'][$i],
                    "id" => $id
                ]) or die(print_r($this->connection->getConnection()->errorInfo()));

                if (!$isOkay) break;
            }

            return ($isOkay);
        }
    }
}