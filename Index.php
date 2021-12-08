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
    'database' => 'wish',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
] );
$db->setAsGlobal();
$db->bootEloquent();
//echo \wishlist\Controlleur\ControlleurItems::afficherToutItem();
/**
 * FIN Eloquent
 */

/**
 * Slim 3
 */
$config = require_once "src/Config/settings.php"; //correspond au contenu de settings.php
$c = new \Slim\Container($config);
$app = new \Slim\App($c);

use wishlist\Controlleur\ControlleurHello as ControlleurHello;

$app->get('/hello/{name}[/]', ControlleurHello::class.':sayHello');

$app->run();
/**
 * FIN Slim 3
 */