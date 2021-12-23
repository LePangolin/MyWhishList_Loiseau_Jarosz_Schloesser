<?php
session_start();
require_once 'vendor/autoload.php';

use wishlist\Authentificateur\Authentication;

Authentication::init();
Authentication::createUser("Admin","1234567891011");
Authentication::authenticate("Admin","1");
echo "<br>";
if(isset($_SESSION['profile']) == null){
    echo "Erreurs de connexion";
}else{
    echo "Connexion réussi";
}

session_destroy();