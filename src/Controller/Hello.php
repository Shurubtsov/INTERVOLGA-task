<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

class Hello {
    public function display() {
        $app = AppFactory::create();

        $app->get('/hello', function (Request $request, Response $response) {
            $response->getBody()->write('Hello World');
            return $response;
        });

        $app->run();
    }
}
