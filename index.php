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
        $controller = new Hello();
        // response return display funcion of Hello with body "helloworld"
        $response->getBody()->write($controller->display());
        return $response;
        
    });

    // connecting to db and if file of db does not exist connection create him in config path
    use App\Db\SQliteConnection;

    $app->get('/connect', function (Request $request, Response $response) {
        // notice
        $pdo = (new SQliteConnection())->connect();
        if ($pdo != null) {
            $response->getBody()->write('Connect to SQLite db is successful');
        } else {
            $response->getBody()->write('Connect to SQLite db denied, something went wrong');
        }
        return $response;
    });

    $app->run();
