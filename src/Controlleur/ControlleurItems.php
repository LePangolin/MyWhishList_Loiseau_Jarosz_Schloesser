<?php
namespace wishlist\Controlleur;

use wishlist\Models\Item as Items;
use wishlist\Vue\VueItems;


class ControlleurItems{

    static function toutItems(){
        return Items::all();
    }

    static function afficherToutItem(){
        return VueItems::afficherToutItem();
    }
}
