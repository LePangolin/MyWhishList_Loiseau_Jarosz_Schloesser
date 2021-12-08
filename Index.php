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
use wishlist\Controlleur\ControlleurHome as ControlleurHome;
use wishlist\Controlleur\ControlleurListes as ControlleurListes;
use wishlist\Controlleur\ControlleurItems as ControlleurItems;

$app->get('/hello/{name}[/]', ControlleurHello::class.':sayHello')
->setName("hello");

$app->get('/liste[/]', ControlleurListes::class.':toutListe')
->setName("liste");

$app->get('/item[/]', ControlleurItems::class.':afficherToutItem')
    ->setName("item");

$app->get('[/]', ControlleurHome::class.':welcome');

$app->run();
/**
 * FIN Slim 3
 */