<?php

namespace wishlist\Vue;

use wishlist\Controlleur\ControlleurItems as ControlleurItems;

class VueItems{

    static function afficherToutItem(){
        $tab_v = ControlleurItems::toutItems();
        $ph = "";
        foreach($tab_v as $value => $it){
            $ph.= $value." : ".$it."<br>";
        }
        return"<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Liste des items</title>
                        </head>
                        <body>
                           <?php
                                <p>$ph</p>
                           ?>
                        </body>
                     </html>";
    }
}