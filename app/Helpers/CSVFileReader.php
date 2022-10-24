<?php

namespace App\Helpers;

use App\Interfaces\FileReaderInterface;
use App\Helpers\CarDataValidation;
use App\Model\CarModel;

class CSVFileReader implements FileReaderInterface
{
    public function read($file_tmp)
    {
        $file = fopen($file_tmp, 'r');
        while (($line = fgetcsv($file)) !== false) {
            $array[] = $line;
        }
        if (!empty($array)) {
            $header = $array[0];
            $validator = new CarDataValidation();
            $response = $validator->validateCSVFields($header);
            if ($response === true) {
                unset($array[0]);
                foreach ($array as $key) {
                    $carModel = new CarModel();
                    $response = $carModel->insertCSVData($key);
                    if (!$response) {
                        return array('error' => true, 'message' => 'Error Occurred');
                    }
                }
                return array('error' => false, 'message' => 'Successfully saved the details');
            } else {
                return array('error' => true, 'message' => 'Invalid CSV');
            }
        }
    }
}
