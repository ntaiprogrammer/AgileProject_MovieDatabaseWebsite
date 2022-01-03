<?php
        $host = 'localhost';
        $username = "DBlink";
        $password = "P@ss";
        $dbname = "movies";     
        $porta = "3306";
        $charset = 'utf8mb4';
// these are the enviroment variables fot the database connection 
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$porta";
        try {
            $pdo = new \PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
//         this is the connection to the database being made.
?>