<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Helpers\CarDataValidation;

class CarDataValidationTest extends TestCase
{
    public function testValidateCSVFields()
    {
        $validationFields = array('Location', 'Fuel type', 'Car year', 'Car Brand',
        'Car Model', 'Number of doors', 'Number of seats', 'Transmission');
        $carDataValidation = new CarDataValidation();
        $result = $carDataValidation->validateCSVFields($validationFields);
        $this->assertEquals(true, $result);
    }

    public function testValidateInvalidCSVFields()
    {
        $validationFields = array('Location1', 'Fuel type', 'Car year', 'Car Brand',
            'Car Model', 'Number of doors', 'Number of seats', 'Transmission');
        $carDataValidation = new CarDataValidation();
        $result = $carDataValidation->validateCSVFields($validationFields);
        $this->assertEquals(false, $result);
    }

    public function testValidateInvalidJsonFields()
    {
        $validationFields = array('Location1', 'Fuel type', 'Car year', 'Car Brand',
            'Car Model', 'Number of doors', 'Number of seats', 'Transmission');
        $carDataValidation = new CarDataValidation();
        $result = $carDataValidation->validateJSONFields($validationFields);
        $this->assertEquals(false, $result);
    }
}