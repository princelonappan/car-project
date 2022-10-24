<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use GuzzleHttp;

class CarControllerTest extends TestCase
{
    public function setUp(): void
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'localhost:8000']);
    }

    public function testGetCarAPIWithNoResult(): void
    {
        $response = $this->http->request('GET', 'car/1');
        $content = json_decode($response->getBody(), true);
        $this->assertNotEmpty($content);
        $this->assertEquals('No Car Details Found', $content['message']);
    }

    public function testGetCarAPIWithResult(): void
    {
        $response = $this->http->request('GET', 'car/68');
        $content = json_decode($response->getBody(), true);

        $this->assertNotEmpty($content);
        $this->assertEquals(true, $content['success']);
        $this->assertNotEmpty($content['car']);
    }

    public function testUploadFileAPIWithOutFile(): void
    {
        $response = $this->http->request('POST', '/car/upload-files');
        $content = json_decode($response->getBody(), true);

        $this->assertNotEmpty($content);
        $this->assertEquals(true, $content['error']);
        $this->assertEquals('Invalid File', $content['message']);
    }

    public function testSaveAPIWithOutContent(): void
    {
        $response = $this->http->request('POST', '/car/save');
        $content = json_decode($response->getBody(), true);

        $this->assertNotEmpty($content);
        $this->assertEquals(true, $content['error']);
        $this->assertEquals('Invalid Car Content', $content['message']);
    }

//    public function testSaveAPIWithContent(): void
//    {
//        $response = $this->http->request('POST', "/car/save", [
//            'json' => [
//                'Car Brand' => "Renault",
//                'Number of seats' => "1",
//                'Transmission' => 'Manual',
//                'Number of doors' => '2',
//                'Car Model' => 'Clio',
//                'Fuel type' => 'Petrol',
//                'Location' => 'Rønde',
//                'Car year' => '2011'
//            ],
//            'headers' => [
//                'Content-Type' => 'application/json',
//            ]]);
//
//        $content = json_decode($response->getBody(), true);
//
//        $this->assertNotEmpty($content);
//        $this->assertEquals(false, $content['error']);
//        $this->assertEquals('Successfully saved the details', $content['message']);
//    }
}