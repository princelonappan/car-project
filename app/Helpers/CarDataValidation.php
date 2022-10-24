<?php

namespace App\Helpers;

class CarDataValidation
{
    public $validationFields = array('Location', 'Fuel type', 'Car year', 'Car Brand',
        'Car Model', 'Number of doors', 'Number of seats', 'Transmission');

    public function validateCSVFields($fields): bool
    {
        $validation = true;
        foreach ($this->validationFields as $key) {
            if (!in_array($key, $fields)) {
                $validation = false;
            }
        }

        return $validation;
    }

    public function validateJSONFields($fields): bool
    {
        $validation = true;
        foreach ($this->validationFields as $key) {
            if (!array_key_exists($key, $fields)) {
                $validation = false;
            }
        }

        return $validation;
    }
}
