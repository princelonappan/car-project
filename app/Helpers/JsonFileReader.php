<?php

namespace App\Helpers;

use App\Helpers\CarDataValidation;
use App\Interfaces\FileReaderInterface;
use App\Model\CarModel;

class JsonFileReader implements FileReaderInterface
{
    public function read($fileTmp)
    {
        $string = file_get_contents($fileTmp);
        $content = json_decode($string, true);
        if (!empty($content)) {
            $validator = new CarDataValidation();
            $response = $validator->validateJSONFields($content[0]);
            if ($response === true) {
                foreach ($content as $key) {
                    $carModel = new CarModel();
                    $response = $carModel->insertJSONData($key);
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
