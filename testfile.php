<?php
session_start();
require_once 'vendor/autoload.php';

use wishlist\Authentificateur\Authentication;

Authentication::init();
Authentication::createUser("Admin","1234567891011");
echo "<br> Avec mauvais identifiant :<br>";
Authentication::authenticate("Admin","1");
echo "<br> Avec bon identifiant :<br>";
Authentication::authenticate("Admin","1234567891011");
echo "<br>";
echo ($_SESSION['profile']['userid']);
