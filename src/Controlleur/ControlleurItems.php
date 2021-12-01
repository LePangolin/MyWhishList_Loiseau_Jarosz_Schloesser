<?php
namespace Controlleur;
use Models\Item;

require_once '../Models/Item.php';

class ControlleurItems{

    static function toutItems(){
        return Item::get();
    }
}
