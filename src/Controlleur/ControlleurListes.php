<?php
namespace wishlist\Controlleur;

use wishlist\Models\Liste as Liste;
use wishlist\Vue\VueItems;


class ControlleurListes{

    public function __construct(\Slim\Container $c){
        $this->c=$c;
    }

    static function toutLitses(){
        return Liste::all();
    }

    static function afficherToutItem(){
        return VueListes::afficherToutesListes();
    }
}
