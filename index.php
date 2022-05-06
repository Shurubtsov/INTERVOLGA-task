<?php

namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . "/vendor/autoload.php";

$app = AppFactory::create();

use App\Controller\Hello;

// requesting to controller which return hello world from slim
$app->get('/hello', function (Request $request, Response $response) {

    // notice controller of Hello class
    $helloController = new Hello();
    // response return display funcion of Hello with body "helloworld"
    $response->getBody()->write($helloController->display());
    return $response;
});

// connecting to db from controller and if file of db does not exist connection create him in config path
use App\Controller\Db;

$app->get('/connect', function (Request $request, Response $response) {
    $dbController = new Db();
    $response->getBody()->write($dbController->connect());
    return $response;
});

// create table from controller
$app->get('/create', function (Request $request, Response $response) {
    $dbController = new Db();
    $response->getBody()->write($dbController->createTable());
    return $response;
});

$app->run();
