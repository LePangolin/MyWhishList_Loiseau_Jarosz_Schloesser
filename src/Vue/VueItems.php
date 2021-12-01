<?php

namespace Vue;
require_once '../Controlleur/ControlleurItems.php';

class VueItems{

    static function afficherToutItem(){
        return '<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="UTF-8">
                            <title>Liste des voitures</title>
                        </head>
                        <body>
                           <?php
                                $tab_v = ControlleurItems::toutItems();
                                vardump($tab_v);
                           ?>
                        </body>
                     </html>';
    }
}