<?php

namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . "/vendor/autoload.php";
require_once ('./storage.php'); // require for access to class of storage

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

// get table list from controller [DON'T WORK****, return null] TODO: fix this
$app->get('/getTable', function (Request $request, Response $response) {
    $dbController = new Db();
    $tables = $dbController->getTable();
    $response->getBody()->write("$tables its tables");
    return $response;
    // ->withHeader('content-type', 'application/json')
    // ->withStatus(200);
});

// task #3 -> return one review from ID argument
$app->get('/api/feedbacks/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];
    $storage = new Storage();
    $review = $storage->getReviewByID($id);

    $response->getBody()->write(json_encode($review));

    return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(200);
});

// request for all reviews from database with pagination (task#2-3)
$app->get('/api/feedbacks', function (Request $request, Response $response, array $args) {
    // optional get query with num of page
    $params = $request->getQueryParams();
    
    if ($params != null) {
        $page = $params['page'];
    } else {
        $page = 1;
    }

    $storage = new Storage();
    $review = $storage->getAllReviews($page, 5);

    $response->getBody()->write(json_encode($review));

    return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(200);
});

$app->run();
