<?php
require_once 'vendor/autoload.php';
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

