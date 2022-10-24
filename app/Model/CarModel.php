<?php

namespace App\Model;

use App\Database\DatabaseConnector;

class CarModel
{
    public $dbConnection;

    public function __construct()
    {
        $dbConnector = new DatabaseConnector();
        $this->dbConnection = $dbConnector->getConnection();
    }

    public function insertCSVData($data)
    {
        $locationModel = new LocationModel();
        $carBrandModel = new CarBrandModel();
        $carTypeModel = new CarTypesModel();
        $carTypesGroup = new CarTypesGroup();
        $locationId = $locationModel->getLocationId($data[0]);
        $brandId = $carBrandModel->getBrandId($data[1]);
        $carTypesGroupId = $carTypesGroup->getTypeGroupId($data[9]);
        $carTypeId = $carTypeModel->getTypeId($data[10]);
        $sql = " INSERT INTO  car (location_id, brand_id, car_model, license_plate,car_year, number_of_doors,
                 number_of_seats, fuel_type, transmission, car_type_group_id, car_type_id) VALUES ";
        $sql .= " ( $locationId, $brandId,
        '" . $data[2] . "', '" . $data[3] . "', '" . $data[4] . "', '" . $data[5] . "', '" . $data[6] . "', '" .
            $data[7] . "', '" . $data[8] . "', $carTypesGroupId
        , $carTypeId) ";

        return $this->dbConnection->query($sql);
    }

    public function insertJSONData($data)
    {
        $locationModel = new LocationModel();
        $carBrandModel = new CarBrandModel();
        $carTypeModel = new CarTypesModel();
        $carTypesGroup = new CarTypesGroup();
        $locationId = $locationModel->getLocationId($data['Location']);
        $brandId = $carBrandModel->getBrandId($data['Car Brand']);
        $carTypesGroupId = $carTypesGroup->getTypeGroupId($data['Car Type Group']);
        $carTypeId = $carTypeModel->getTypeId($data['Car Type']);

        $sql = " INSERT INTO  car (location_id, brand_id, car_model, license_plate,car_year, number_of_doors,
                 number_of_seats, fuel_type, transmission, car_type_group_id, car_type_id, inside_height, 
                   inside_length, inside_width) VALUES ";
        $sql .= " ( $locationId, $brandId,
        '" . $data['Car Model'] . "', '" . $data['License plate'] . "', '" . $data['Car year'] . "', 
        '" . $data['Number of doors'] . "', '" . $data['Number of seats'] . "', 
        '" . $data['Fuel type'] . "', '" . $data['Transmission'] . "',  '" . $carTypesGroupId . "'
        ,  '" . $carTypeId . "', '" . $data['Inside height'] . "', '" . $data['Inside length'] . "',
         '" . $data['Inside width'] . "') ";

        return $this->dbConnection->query($sql);
    }

    public function getCarDetails($carId)
    {
        $sql = " SELECT ca.id as car_id, transmission, fuel_type, car_year, number_of_doors, 
                number_of_seats, license_plate, 
                inside_length, inside_height, inside_width, car_km, 
                 car_model, l.name as location_name, cb.brand_name, ctg.name as car_type_group_name,
                 ct.name as car_type_name FROM `car` as ca 
                 LEFT JOIN location as l on (ca.location_id = l.id) 
                LEFT JOIN car_brand as cb ON (ca.brand_id = cb.id) 
                LEFT JOIN  car_type_group as ctg ON (ca.car_type_group_id = ctg.id) 
                LEFT JOIN car_types as ct ON (ca.car_type_id = ct.id)
                Where ca.id = '$carId'";
        $result = $this->dbConnection->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (!empty($row)) {
            return $row;
        } else {
            return null;
        }
    }
}
