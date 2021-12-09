<?php
namespace wishlist\Controlleur;

use Slim\Container;
use wishlist\Models\Liste as Liste;
use wishlist\Vue\VueListes;


class ControlleurListes{
    private Container $c;
    public function __construct($c){
        $this->c = $c;
    }

    static function toutListes(){
        return Liste::all();
    }

    function afficherToutesListes(){
        $vue = new VueListes($this->c);
        return $vue->afficherToutesListes();
    }
}
