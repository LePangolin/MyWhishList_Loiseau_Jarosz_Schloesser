<?php
require_once 'vendor/autoload.php';

/**
 * Eloquent
 */
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB();
$db->addConnection( [
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'php',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
] );
$db->setAsGlobal();
$db->bootEloquent();
echo \wishlist\Controlleur\ControlleurItems::afficherToutItem();
/**
 * FIN Eloquent
 */

/**
 * Slim 3
 */
use src\Controlleur\ControlleurHello;
$config = require_once "src/Config/settings.php"; //correspond au contenu de settings.php
$c = new \Slim\Container($config);
$app = new \Slim\App($c);

// Les routes doivent être faîte de la plus complexe à la plus simple

$app->get('/hello/{name}', ControlleurHello::class.'');

$app->run();
/**
 * FIN Slim 3
 */
