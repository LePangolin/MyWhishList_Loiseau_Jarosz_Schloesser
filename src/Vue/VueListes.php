<?php
namespace wishlist\Vue;

use wishlist\Controlleur\ControlleurListes as ControlleurListes;

class VueListes{

    static function afficherToutesListes(){
        $tab_v = ControlleurListes::toutListes();
        $ph = "";
        foreach($tab_v as $it){
            $ph.= $it->no." : ".$it->titre."<br>";
        }

        $chemin = ControlleurListes::getC()->router->pathFor("home");

        $tabUrl = array(
            1=>$chemin
        );

        return"<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Liste des Listes</title>
                        </head>
                        <body>
                                <h1>Liste des listes</h1>
                                
                                <p>$ph</p>
                                
                                <p><a href=$tabUrl[1]>Retour à la page d'accueuil</a></p>
                        </body>
                     </html>";
    }
}