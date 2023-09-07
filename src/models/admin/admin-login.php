<?php

namespace Application\Model\Admin\Login;

require_once('src/lib/db_connect.php');

class LoginAdmin {
    public string $email;
    public string $password;
}

class AuthenticateAdmin {

    public \DatabaseConnection $connection;

    public function authenticateAdmin(array $input)
    {
        echo 'model/admin.........';
        $loginAdmin = new LoginAdmin();
        $loginAdmin->email = $input['email'];
        $loginAdmin->password = $input['password'];

        $query = "SELECT * FROM users";
        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute();
        $identifierAdmin = $statement->fetchAll(\PDO::FETCH_ASSOC);

        var_dump($identifierAdmin);

        foreach ($identifierAdmin as $identifier)
        {
            if ($identifier['email'] == $loginAdmin->email && $identifier['password'] == $loginAdmin->password)
            {
                return ([
                    'valid' => true,
                    'arrayInfos' => $identifier['idUser']
                ]);
            }
        }
        return (false);
    }
}