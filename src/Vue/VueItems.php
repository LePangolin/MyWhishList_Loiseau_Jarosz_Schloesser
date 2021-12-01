<?php

namespace wishlist\Vue;
use wishList\Controlleur\ControlleurItems as ControlleurItems;

class VueItems{

    static function afficherToutItem(){
        $tab_v = ControlleurItems::toutItems();
        return"<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Liste des items</title>
                        </head>
                        <body>
                           <?php
                                var_dump($tab_v);
                           ?>
                        </body>
                     </html>";
    }
}