<?php

namespace App\Model;

use App\Database\DatabaseConnector;

class LocationModel
{
    public $dbConnection;

    public function __construct()
    {
        $dbConnector = new DatabaseConnector();
        $this->dbConnection = $dbConnector->getConnection();
    }

    public function getLocationId($name)
    {
        $sql = "SELECT * from location where name='$name'";
        $result = $this->dbConnection->query($sql);
        $row = $result->fetch_array();
        if (!empty($row)) {
            return $row['id'];
        } else {
            return null;
        }
    }
}
