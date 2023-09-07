<?php

namespace Application\Model\User;

class ReceiveInfos {
    public \DatabaseConnection $connection;

    public function receiveInfos()
    {
        $query = 'SELECT d.idDoc, d.topicDoc, d.titleDoc, d.summaryDoc, d.pathImageDoc, d.pathDoc, CONCAT(a.nameAuthor, a.firstName) AS authors
                    FROM documents AS d
                    JOIN documentsauthors AS da
                    ON d.idDoc = da.idDoc
                    JOIN authors AS a 
                    ON da.idAuthor = a.idAuthor
                    GROUP BY idDoc';

        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute();
        $documents = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return ($documents);
    }

    public function searchData(array $input)
    {
        $search = $input['search'];
        $search = "%$search%";
        $query = 'SELECT * FROM documents AS d
                    JOIN documentsauthors AS da
                    ON d.idDoc = da.idDoc
                    JOIN authors AS a 
                    ON da.idAuthor = a.idAuthor
                    WHERE d.topicDoc LIKE :search OR d.keywords LIKE :search OR a.nameAuthor LIKE :search OR a.firstName LIKE :search';

        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute([
           'search' => $search
        ]);

        $documents = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return ($documents);
    }
}
