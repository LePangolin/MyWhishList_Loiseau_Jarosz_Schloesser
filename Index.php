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

use wishlist\Controlleur\ControlleurHello;
use wishlist\Controlleur\ControlleurHome;
use wishlist\Controlleur\ControlleurListes;
use wishlist\Controlleur\ControlleurItems;

/**
 * test
 */
$app->get('/hello/{name}[/]', ControlleurHello::class.':sayHello')
    ->setName("hello");

/**
 * liste
 */
$app->get('/liste/{no}/item/{id}[/]', ControlleurItems::class.':afficherUnItem')
    ->setName("itemUnite");

$app->get('/liste/{no}[/]', ControlleurListes::class.':afficherUneListe')
    ->setName("listeUnite");

$app->get('/liste[/]', ControlleurListes::class.':afficherToutesListes')
    ->setName("listeAll");

/**
 * item
 */


$app->get('/item[/]', ControlleurItems::class.':afficherToutItem')
    ->setName("itemAll");

/**
 * home
 */
$app->get('[/]', ControlleurHome::class.':welcome')
    ->setName("home");

$app->run();
/**
 * FIN Slim 3
 */