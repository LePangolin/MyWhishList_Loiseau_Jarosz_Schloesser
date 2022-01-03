<?php
namespace wishlist\Vue;

use Slim\Container;
use wishlist\Controlleur\ControlleurItems;
use wishlist\Controlleur\ControlleurListes as ControlleurListes;

class VueListes{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    function afficher($no=null){
        $tab_v = ControlleurListes::toutListes();
        $tab_i = ControlleurItems::toutItems();
        $ph = "";
        $tabUrl = array(
            1=>$this->c->router->pathFor("listeAll")
        );


        $vue = new VueHTML($this->c);

        if($no==null){
            foreach($tab_v as $it){
                $url = $this->c->router->pathFor( 'listeUnite', ['no'=> $it->no] ) ;
                $ph.= "<a class='link-info' href='".$url."'> " . $it->titre . "</a><br>";
            }
            $res = <<<END
                        <body>
                                <h1>Listes publiques</h1>
                                
                                <p>$ph</p>
                                
                        </body>
                     
                     END;
        } else {

            foreach ($tab_i as $item){

                $url = $this->c->router->pathFor( 'itemUnite' , ['no'=> $no, 'id' => $item->id]);
                if($item->liste_id == $no){
                    $ph .= "<h3>"  . $item->nom . "</h3>".
                        "<img style='width: 200px;' src=/MyWishList_Jarosz_Loiseau_Schloesser/img/".$item->img.">".
                        "<p>état de réservation : $item->tarif <br> <a href=$url class='link-info'> en savoir plus </a></p>"; //changer tarif
                }
            }

            foreach($tab_v as $li){

                if($li->no == $no){
                    $infoListe="<h1>$li->titre</h1><h2>$li->description</h2>";
                }
            }
            $res = <<<END
                <container>
                    <p>$infoListe $ph</p>
                    <p><a class='btn btn-outline-dark text-light' href="$tabUrl[1]" role='button'>Voir un autre exemple de liste</a></p>
                </container>
                END;
        }

        return($vue->getNav().$res.$vue->getFooter());
    }
}