<?php

namespace App\Controller;

use App\Helpers\CarDataValidation;
use App\Helpers\JsonFileReader;
use App\Helpers\CSVFileReader;
use App\Model\CarModel;

class Car
{
    public function getCareDetails($carID): array
    {
        $carModel = new CarModel();
        $carInfo = $carModel->getCarDetails($carID);
        if (!empty($carInfo)) {
            $response = array('success' => true, 'car' => $carInfo);
        } else {
            $response = array('success' => false, 'message' => 'No Car Details Found');
        }
        return $response;
    }


    public function upload()
    {
        if (isset($_FILES['file'])) {
            $errors = array();
            $fileTmp = $_FILES['file']['tmp_name'];
            $fileExt = strtolower(end(explode('.', $_FILES['file']['name'])));
            $extensions = array("csv", "json");

            if (in_array($fileExt, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a CSV or JSON file.";
            }

            if (empty($errors)) {
                if ($fileExt == 'csv') {
                    $filerReader = new CSVFileReader();
                } else {
                    $filerReader = new JsonFileReader();
                }
                return $filerReader->read($fileTmp);
            } else {
                return array('error' => true, 'message' => $errors);
            }
        } else {
            return array('error' => true, 'message' => 'Invalid File');
        }
    }

    public function save($request): array
    {
        $validator = new CarDataValidation();
        $objectToArray = (array)$request;
        $validationResponse = $validator->validateJSONFields($objectToArray);
        if ($validationResponse === true) {
            $carModel = new CarModel();
            $response = $carModel->insertJSONData($objectToArray);
            if ($response) {
                return array('error' => false, 'message' => 'Successfully saved the details');
            } else {
                return array('error' => true, 'message' => 'Error Occurred');
            }
        } else {
            return array('error' => true, 'message' => 'Invalid Car Content');
        }
    }
}
