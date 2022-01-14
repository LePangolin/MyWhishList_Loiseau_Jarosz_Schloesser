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

    function afficherItem($id=null, $no){
        $tab_v = ControlleurItems::toutItems();

        $vue = new VueHTML($this->c);

        $tabUrl = array(
            1=>$this->c->router->pathFor("listeUnite", ["no"=> $no])
        );

        $ph="";

        if($id==null){
            foreach($tab_v as $it){
                $url = $this->c->router->pathFor( 'itemUnite', ['id'=> $it->id] ) ;
                $ph .= "<a href='".$url."'> </br>" . $it->id . " : " . $it->nom . "</a>";
            }
        } else {
            $tab_r=ControlleurItems::toutReservation();
            $estReserve=false;
            foreach($tab_v as $it){
                if($it->id == $id){
                    $ph = "<h2>$it->nom</h2>".
                        "<img style='width: 200px;' src=/MyWishList_Jarosz_Loiseau_Schloesser/img/".$it->img.">".
                        "<p>$it->descr, prix : $it->tarif</p>";
                    foreach ($tab_r as $reservation){
                        if ($reservation->iditem == $it->id){
                            $estReserve=true;
                        }
                    }
                    if(!$estReserve){
                        $ph.="<h1>Faire le formulaire</h1>";
                    } else {
                        $ph.="<p>L'item est déjà réservé</p>";
                    }
                }
            }

        }

        return($vue->getNav()."<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Liste des items</title>
                        </head>
                        <body>
                                <h1>Items</h1>
                        
                                <p>$ph</p>
                                
                                <a class='btn btn-info text-light' href=$tabUrl[1] role=button>Retour à la liste</a>
                        </body>
                     </html>".$vue->getFooter());
    }
}