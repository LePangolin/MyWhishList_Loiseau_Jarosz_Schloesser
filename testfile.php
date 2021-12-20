<?php
session_start();
require_once 'vendor/autoload.php';

use wishlist\Authentificateur\Authentication;

Authentication::init();
Authentication::createUser("Admin","1234567891011");
Authentication::authenticate("Admin","1234567891011");
var_dump($_SESSION['profile']);