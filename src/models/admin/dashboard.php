<?php

namespace Application\Model\Admin\Dashboard;

require_once('src/lib/db_connect.php');

class ExtractInfoAdmin {
    public \DatabaseConnection $connection;

    public function extract(string $id)
    {

        $query = 'SELECT * FROM users WHERE idUser = :id';
        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute([
            'id' => $id
        ]);

        $identifier = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return ($identifier);
    }
}
