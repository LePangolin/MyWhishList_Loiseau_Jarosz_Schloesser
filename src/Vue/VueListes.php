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

    function afficher($token=null){
        $tab_v = ControlleurListes::toutListes();
        $tab_i = ControlleurItems::toutItems();
        $ph = "";
        $tabUrl = array(
            1=>$this->c->router->pathFor("listeAll")
        );


        $vue = new VueHTML($this->c);

        if($token==null){
            foreach($tab_v as $it){
                if($it->publique != '0'){
                    $url = $this->c->router->pathFor( 'listeUnite', ['no'=> $it->no] ) ;
                    $ph.= "<a class='link-info' href='".$url."'> " . $it->titre . "</a><br>";
                }
            }
            $res = <<<END
                        <body>
                                <h1>Listes publiques</h1>
                                
                                <p>$ph</p>
                                
                        </body>
                     
                     END;
        } else {

            foreach($tab_v as $li){

                if($li->token == $token){
                    $infoListe="<h1>$li->titre</h1><h2>$li->description</h2>";
                    $no = $li->no;
                }
            }

            foreach ($tab_i as $item){

                $url = $this->c->router->pathFor( 'itemUnite' , ['no'=> $no, 'id' => $item->id]);
                if($item->liste_id == $no){
                    $ph .= "<h3>"  . $item->nom . "</h3>".
                        "<img style='width: 200px;' src=/MyWishList_Jarosz_Loiseau_Schloesser/img/".$item->img.">".
                        "<p>état de réservation : $item->tarif <br> <a href=$url class='link-info'> en savoir plus </a></p>"; //changer tarif
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
        $url = $this->c->router->pathFor("AccesList");
        if ($idUser==null){
            $res = <<<END
            <p></p><br>
            <h1>Vous n'êtes pas connecté</h1>
            <h5>Veuillez entrer le token de la liste privé dont vous voulez accéder</h5>
            <form method="post" action="$url">
            <br><input type="text" name="input"><br>
            <br><button class='btn btn-outline-dark text-light' id="button" role='button' >Acceder à la liste</button></form>
            END;

        } else {
            $userName=$_SESSION['profile']['username'];

            $res = <<<END
            <h1>Bonjour $userName</h1>
            <h2>Vos listes :</h2>
            <p></p>
            <h2>Accès à une liste privée</h2>
            <p>Veuillez entrer le token de la liste privé dont vous voulez accéder</p>
            <form method="post" action="$url">
            <br><input type="text" name="input"><br>
            <br><button class='btn btn-outline-dark text-light' id="button" role='button' type="submit">Acceder à la liste</button></form>
            END;
        }
        return($vue->getNav().$res.$vue->getFooter());
    }
}