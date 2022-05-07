<?php

namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . "/../vendor/autoload.php";
require_once('public/storage.php'); // require for access to class of storage
require_once('src/Db/Config.php'); // config

$app = AppFactory::create();

use App\Controller\Hello;


// requesting to controller which return hello world from slim
$app->get('/hello', function (Request $request, Response $response) {

    $helloController = new Hello();
    // response return display funcion of Hello with body "helloworld"
    $response->getBody()->write($helloController->display());
    return $response;
});


// connecting to db from controller and if file of db does not exist connection create him in config path
use App\Controller\Db;
use App\Db\Config;

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
$app->get('/api/feedbacks', function (Request $request, Response $response) {
    // optional get query with num of page
    $params = $request->getQueryParams();

    // if request don't have param "page" we set default value -> 1 page
    if ($params != null) {
        $page = $params['page'];
    } else {
        $page = 1;
    }

    $storage = new Storage();
    $review = $storage->getAllReviews($page, 20);

    $response->getBody()->write(json_encode($review));

    return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(200);
});

// parser for body of post requests
$app->addBodyParsingMiddleware();

// post request for add review to database (TASK #4)
$app->post('/api/feedbacks/add', function (Request $request, Response $response) {

    $params = $request->getParsedBody();
    $storage = new Storage();

    if ($params != null) {

        $username = $params['username'];
        $text = $params['text'];

        $storage->insertData($username, $text);
    }

    return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(200);
});


// controller for deleting reviews from db on his id
$app->delete('/api/feedbacks/delete/{id}', function (Request $request, Response $response, array $args) {

    // basic auth via headers
    if (($_SERVER['PHP_AUTH_USER'] == 'admin' && ($_SERVER['PHP_AUTH_PW'] == 'admin'))) {

        $id = $args['id'];
        $storage = new Storage();

        $storage->deleteReview($id);
        print('review deleted!');
    } else {
        header("WWW-Authenticate: Basic realm=\"Private request\"");
        header("HTTP/1.0 401 Unauthorized");
        print("this request only for admins");
    }


    return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(200);
});


$app->run();
