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

use wishlist\Controlleur\ControlleurHome;
use wishlist\Controlleur\ControlleurListes;
use wishlist\Controlleur\ControlleurItems;


/**
 * liste
 */
$app->get('/liste/{no}/item/{id}[/]', ControlleurItems::class.':afficherUnItem')
    ->setName("itemUnite");

$app->get('/liste/{no}[/]', ControlleurListes::class.':afficherUneListe')
    ->setName("listeUnite");

$app->get('/utilisateur/', ControlleurListes::class.':afficherListeUtilisateur')
    ->setName("AccesList");

$app->get('/liste/[/]', ControlleurListes::class.':afficherToutesListes')
    ->setName("listeAll");

/**
 * Connexion
 */
$app->get('/connexion[/]',\wishlist\Controlleur\ControlleurConnexion::class.':connexion')
    ->setName('Connexion');

$app->get('/inscription[/]',\wishlist\Controlleur\ControlleurConnexion::class.':creerUnCompte')
    ->setName('Creation de compte');

/**
 * Création Liste
 */
$app->get('/creat[/]', ControlleurListes::class.':creeListe')
    ->setName("creatListe");

/**
 * item
 */
$app->get('/item[/]', ControlleurItems::class.':afficherToutItem')
    ->setName("itemAll");

/**
 * home
 */
$app->get('/Fonctionnalites', ControlleurHome::class.':afficherFonctionnalites')
    ->setName("Fonctionnalites");

$app->get('/CommentCaMarche', ControlleurHome::class.':afficherTuto')
    ->setName("tuto");

$app->get('/AboutUs', ControlleurHome::class.':afficherNosInfos')
    ->setName("a Propos de nous");

$app->get('[/]', ControlleurHome::class.':welcome')
    ->setName("home");

$app->run();




/**
 * FIN Slim 3
 */