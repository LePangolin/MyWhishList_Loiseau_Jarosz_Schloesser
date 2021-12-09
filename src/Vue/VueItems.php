<?php

namespace wishlist\Vue;

use Slim\Container;
use wishlist\Controlleur\ControlleurItems as ControlleurItems;

class VueItems{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    function afficherToutItem(){
        $tab_v = ControlleurItems::toutItems();
        $ph = "";
        foreach($tab_v as $it){
            $ph.= $it->id." : ".$it->nom."<br>";
        }

        $tabUrl = array(
            1=>$this->c->router->pathFor("home")
        );
        //image : <br><img style='width: 100px;' src=/MyWishList_Jarosz_Loiseau_Schloesser/img/".$it->img.">

        return"<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Liste des items</title>
                        </head>
                        <body>
                                <h1>Liste des Items</h1>
                        
                                <p>$ph</p>
                                
                                <p><a href=$tabUrl[1]>Retour à la page d'accueuil</a></p>
                        </body>
                     </html>";
    }

}