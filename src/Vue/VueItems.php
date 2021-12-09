<?php

namespace wishlist\Vue;

use wishlist\Controlleur\ControlleurItems as ControlleurItems;

class VueItems{

    static function afficherToutItem(){
        $tab_v = ControlleurItems::toutItems();
        $ph = "";
        foreach($tab_v as $it){
            $ph.= $it->id." : ".$it->nom."<br>";
        }

        //image : "<img style='width: 100px;' src=/MyWishList_Jarosz_Loiseau_Schloesser/img/".$it->img.">

        return"<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Liste des items</title>
                        </head>
                        <body>
                                <p>$ph</p>
                        </body>
                     </html>";
    }

    static function afficherUnItem(){

    }
}