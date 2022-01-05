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
                //mettre un if si la liste est publique, dans la bdd c'est par défaut en false
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

    /**
     * Function afficherPerso correspondant à l'interaction du click sur le button "Mes Listes"
     * @param null $idUser : id de l'utilisateur
     * le parametre permet de savoir si l'utilisateur est connecté ou non
     */
    function afficherPerso($idUser=null){

        $vue = new VueHTML($this->c);

        if ($idUser==null){
            $res = <<<END
            <p></p><br>
            <h1>Vous n'êtes pas connecté</h1>
            <p>Veuillez entrer le token de la liste privé dont vous voulez accéder</p>
            <input><br>
            <button>Acceder à la liste</button>
            END;

        } else {
            $userName=$_SESSION['profile']['username'];

            $res = <<<END
            <h1>Bonjour $userName</h1>
            <h2>Vos listes :</h2>

            <h2>Accès à une liste privée</h2>
            <p>Veuillez entrer le token de la liste privé dont vous voulez accéder</p>
            <input><br>
            <button>Acceder à la liste</button>
            END;

        }

        return($vue->getNav().$res.$vue->getFooter());
    }
}