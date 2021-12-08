<?php
require_once 'vendor/autoload.php';

/**
 * Eloquent
 */
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB();
$db->addConnection(parse_ini_file('src/Config/dbconfig.ini'));
$db->setAsGlobal();
$db->bootEloquent();
//echo \wishlist\Controlleur\ControlleurItems::afficherToutItem();
/**
 * FIN Eloquent
 */

/**
 * Slim 3
 */
//use src\Controlleur\ControlleurHello as ControlleurHello;
//$config = require_once "src/Config/settings.php"; //correspond au contenu de settings.php
//$c = new \Slim\Container($config);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App(/*$c*/);

// Les routes doivent être faîte de la plus complexe à la plus simple

$app->get('/hello/{name}[/]', function (Request $request, Response $response, array $array): Response{
    $name= $array['name'];
    $response->getBody()->write("<h1>Hello, $name</h1>");
    return  $response;
});

//$app->get('/hello/{name}[/]', ControlleurHello::class.':sayHello');



$app->run();
/**
 * FIN Slim 3
 */