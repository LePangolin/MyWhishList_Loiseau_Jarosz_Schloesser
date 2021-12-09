<?php
namespace wishlist\Controlleur;

use wishlist\Models\Liste as Liste;
use wishlist\Vue\VueListes;


class ControlleurListes{


    static function getC(){
        $config = require_once "src/Config/settings.php"; //correspond au contenu de settings.php
        $c = new \Slim\Container($config);
        return $c;
    }

    static function toutListes(){
        return Liste::all();
    }

    static function afficherToutesListes(){
        return VueListes::afficherToutesListes();
    }
}
