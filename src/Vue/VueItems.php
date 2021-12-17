<?php

namespace wishlist\Vue;

use Slim\Container;
use wishlist\Controlleur\ControlleurItems as ControlleurItems;
use wishlist\Models\Item;

class VueItems{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    function afficherToutItem($id=null){
        $tab_v = ControlleurItems::toutItems();

        $UrlHome=$this->c->router->pathFor("home");

        $ph="";

        if($id==null){
            foreach($tab_v as $it){
                $url = $this->c->router->pathFor( 'itemUnite', ['id'=> $it->id] ) ;
                $ph .= "<a href='".$url."'> </br>" . $it->id . " : " . $it->nom . "</a>";
            }
        } else {
            $url = $this->c->router->pathFor('itemAll');
            foreach($tab_v as $it){
                if($it->id == $id){
                    $ph = "<h2>$it->nom</h2>".
                        "<img style='width: 100px;' src=/MyWishList_Jarosz_Loiseau_Schloesser/img/".$it->img.">".
                        "<p>$it->descr</p>"." "."<p>$it->tarif</p>";

                }

            }
            $ph .= "<br><a href=$url> retour à l'affichage des items</a>";
        }

        return"<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Liste des items</title>
                        </head>
                        <body>
                                <h1>Items</h1>
                        
                                <p>$ph</p>
                                
                                <p><a href=$UrlHome>Retour à la page d'accueuil</a></p>
                        </body>
                     </html>";

    }
}