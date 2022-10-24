<?php

namespace App\Model;

use App\Database\DatabaseConnector;

class CarBrandModel
{
    public $dbConnection;

    public function __construct()
    {
        $dbConnector = new DatabaseConnector();
        $this->dbConnection = $dbConnector->getConnection();
    }

    public function getBrandId($name)
    {
        $sql = "SELECT * from car_brand where brand_name='$name'";
        $result = $this->dbConnection->query($sql);
        $row = $result->fetch_array();
        if (!empty($row)) {
            return $row['id'];
        } else {
            return null;
        }
    }
}
