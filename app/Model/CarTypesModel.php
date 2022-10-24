<?php

namespace App\Model;

use App\Database\DatabaseConnector;

class CarTypesModel
{
    public $dbConnection;

    public function __construct()
    {
        $dbConnector = new DatabaseConnector();
        $this->dbConnection = $dbConnector->getConnection();
    }

    public function getTypeId($name)
    {
        $sql = "SELECT * from car_types where name='$name'";
        $result = $this->dbConnection->query($sql);
        $row = $result->fetch_array();
        if (!empty($row)) {
            return $row['id'];
        } else {
            return null;
        }
    }
}
