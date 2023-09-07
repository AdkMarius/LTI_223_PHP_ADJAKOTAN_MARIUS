<?php

namespace Application\Model\Admin\ViewDocument;

require_once ('src/lib/db_connect.php');

class ExtractData {
    public \DatabaseConnection $connection;

    public function viewDoc ()
    {
        $connect = new \DatabaseConnection();

        $query = 'SELECT d.topicDoc, d.titleDoc, d.summaryDoc, CONCAT(a.nameAuthor, a.firstName) AS infosAuthor, d.keywords, d.dateInsertDoc
                  FROM documents AS d
                  JOIN documentsauthors AS da
                  ON d.idDoc = da.idDoc
                  JOIN authors AS a 
                  ON da.idAuthor = a.idAuthor';

        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute();
        $infosDoc = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return ($infosDoc);
    }
}