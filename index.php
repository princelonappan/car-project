<?php
require 'bootstrap.php';

use App\Helpers\Router;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Controller\Car;


Router::get('/car/([0-9]*)', function (Request $req, Response $res) {
    $res->toJSON( (new Car())->getCareDetails($req->params[0]));
});

Router::post('/car/upload-files', function (Request $req, Response $res) {
    $res->toJSON( (new Car())->upload());
});

Router::post('/car/save', function (Request $req, Response $res) {
    $res->toJSON( (new Car())->save($req->getJSON()));
});