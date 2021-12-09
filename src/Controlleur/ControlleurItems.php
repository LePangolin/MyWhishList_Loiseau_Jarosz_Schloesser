<?php
namespace wishlist\Controlleur;

use Slim\Container;
use wishlist\Models\Item as Items;
use wishlist\Vue\VueItems;


class ControlleurItems{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    static function toutItems(){
        return Items::all();
    }

    function afficherToutItem(){
        $vue = new VueItems($this->c);
        return $vue->afficherToutItem();
    }
}
