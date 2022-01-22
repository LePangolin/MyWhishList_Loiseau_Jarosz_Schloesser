<?php

namespace wishlist\Vue;

use Slim\Container;
use wishlist\Controlleur\ControlleurItems as ControlleurItems;
use wishlist\Controlleur\ControlleurListes;
use wishlist\Models\Item;

class VueItems{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    function afficherItem($no, $id=null){
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
            $tab_l=ControlleurListes::toutListes();
            $estReserve=false;
            foreach($tab_v as $it){
                if($it->id == $id){
                    $ph = "<h2>$it->nom</h2>".
                        "<img style='width: 200px;' src=/MyWishList_Jarosz_Loiseau_Schloesser/img/".$it->img.">".
                        "<p>$it->descr, prix : $it->tarif</p>".
			"<p>$it->url<p>";
                    foreach ($tab_r as $reservation){
                        if ($reservation->iditem == $it->id){
                            $estReserve=true;
                            $nom=$reservation->nom;
                            $commentaire=$reservation->commentaire;
                        }
                    }
                    if(!$estReserve){
                        $urlr = $this->c->router->pathFor( 'reservation', ['id' => $it->id]) ;
                        $ph.="<p>L'item n'est pas réservé</p>               
                            <a href='".$urlr."'>Je veux le réserver !</a>";
                    } else {
                        /*la date d'échéance est passée et
                        l'utilisateur est le créateur de la liste on affiche les infos de la reservation*/
                        foreach ($tab_l as $liste){
                            if($liste->no == $it->liste_id){
                                if(isset($_SESSION["profile"])){
                                    if($_SESSION["profile"]["userid"] == $liste->user_id && $liste->expiration<date("F j, Y, a")){
                                        $ph.="<p>$nom $commentaire</p>";
                                    } else {
                                        $ph.="<p>L'item est déjà réservé</p>";
                                    }
                                }
                            }
                        }

                    }
                }
            }

        }

        return($vue->getNav()."
                                <h1>Items</h1>
                        
                                <p>$ph</p>
                                
                                <a class='btn btn-info text-light' href=$tabUrl[1] role=button>Retour à la liste</a>
                     </html>".$vue->getFooter());
    }
}