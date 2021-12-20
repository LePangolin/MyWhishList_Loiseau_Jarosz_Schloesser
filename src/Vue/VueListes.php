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
            1=>$this->c->router->pathFor("home"),
            2=>$this->c->router->pathFor("listeAll")
        );



        $vue = new VueHTML($this->c);

        if($no==null){
            foreach($tab_v as $it){
                $url = $this->c->router->pathFor( 'listeUnite', ['no'=> $it->no] ) ;
                $ph.= "<a class='link-info' href='".$url."'> " . $it->no . " : " . $it->titre . "</a><br>";
            }
            $res = <<<END
                        <body>
                                <h1>Exemple de listes</h1>
                                
                                <p>$ph</p>
                                
                                <p><a class='btn btn-outline-dark text-light' href="$tabUrl[1]" role='button'>Retour à l'accueil</a></p>
                        </body>
                     
                     END;
        } else {
            foreach ($tab_i as $item){
                $url = $this->c->router->pathFor( 'itemUnite' , ['id' => $item->id]);
                if($item->liste_id == $no){
                    $ph .= "<h2>$item->nom</h2>".
                        "<img style='width: 100px;' src=/MyWishList_Jarosz_Loiseau_Schloesser/img/".$item->img.">".
                        "<p>$item->descr</p>"." "."<p>$item->tarif</p>";

                }
            }
            $res = <<<END
                <container>
                    <h2>"Contenu de la liste n°$no"<h2>
                    <p>$ph</p>
                    <p><a class='btn btn-outline-dark text-light' href="$tabUrl[2]" role='button'>Voir un autre exemple de liste</a></p>
                    <p><a class='btn btn-outline-dark text-light' href="$tabUrl[1]" role='button'>Retour à l'accueil</a></p>    
                </container>
                END;
        }

        return($vue->getNav().$res.$vue->getFooter());
    }
}