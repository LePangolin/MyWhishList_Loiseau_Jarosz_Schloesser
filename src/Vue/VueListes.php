<?php
namespace wishlist\Vue;

use wishlist\Controlleur\ControlleurListes as ControlleurListes;

class VueListes{

    static function afficherToutItem(){
        $tab_v = ControlleurListes::toutListes();
        $ph = "";
        foreach($tab_v as $value => $it){
            $ph.= $value." : ".$it."<br>";
        }
        return"<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Liste des Listes</title>
                        </head>
                        <body>
                           <?php
                                <p><!--$ph-->val</p>
                        </body>
                     </html>";
    }
}