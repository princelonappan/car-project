<?php

namespace App\Database;

class DatabaseConnector
{
    private $dbConnection = null;

    public function __construct()
    {
        try {
            $this->dbConnection = new \mysqli('localhost', 'root', 'root', 'oscar_car_rental');

            if (mysqli_connect_errno()) {
                throw new \Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}
