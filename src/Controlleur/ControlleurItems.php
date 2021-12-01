<?php
namespace wishlist\Controlleur;
use whishList\Models\Item as Item;

require_once './Models/Item.php';

class ControlleurItems{

    static function toutItems(){
        return Item::get();
    }
}
