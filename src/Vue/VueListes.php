<?php
namespace wishlist\Vue;

use Slim\Container;
use wishlist\Authentificateur\Authentication;
use wishlist\Controlleur\ControlleurItems;
use wishlist\Controlleur\ControlleurListes;

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
            $compteur = 0;
            foreach($tab_v as $it){
                $compteur++;
                if($it->publique != '0'){
                    $url = $this->c->router->pathFor( 'listeUnite', ['no'=> $it->token] ) ;
                    $ph.= "<p>liste n°$compteur : <a class='link-info m-3' href='".$url."'> " . $it->titre . "</a>$it->expiration</p><br>";

                }
            }
            $res = <<<END
                        <body>
                                <h1>Listes publiques</h1>
                                
                                <div class="text-start container w-50">$ph</div>
                                
                        </body>
                     
                     END;
        } else {

            foreach($tab_v as $li){

                if($li->token == $token){
                    $infoListe="<h1>$li->titre</h1><h2>$li->description</h2><h3>date d'échéance : $li->expiration</h3><h4>$li->commentaire</h4>";
                    $no = $li->no;
                }
            }

            $tab_r=ControlleurItems::toutReservation();
            foreach ($tab_i as $item){
                if($item->liste_id == $no){

                }
                $url = $this->c->router->pathFor( 'itemUnite' , ['no'=> $token, 'id' => $item->id]);
                foreach ($tab_r as $reservation){
                    if($item->liste_id == $no){
                        $ph .= "<div class='border-bottom border-dark w-50 mx-auto'><h3>"  . $item->nom . "</h3>
                        <img style='width: 200px;' src=/MyWishList_Jarosz_Loiseau_Schloesser/img/".$item->img.">";
                        if($item->id == $reservation->iditem){
                            $ph.= "<p>état de réservation : réservé<br>"."<a href=$url class='link-info'> en savoir plus </a></p></div>";
                        } else {
                            $ph.= "<p>état de réservation : non réservé<br>"."<a href=$url class='link-info'> en savoir plus </a></p></div>";
                        }
                    }
                }
            }
            
                $res = <<<END
                <container>
                    <p>$infoListe $ph</p>
                    <p><a class='btn btn-info text-light' href="$tabUrl[1]" role='button'>Voir un autre exemple de liste</a></p>
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
        $ph="";
        if ($idUser==null){
            $res = <<<END
            <p></p><br>
            <h1>Vous n'êtes pas connecté</h1>
            <h5>Veuillez entrer le token de la liste privé dont vous voulez accéder</h5>
            <form method="post" action="$url">
            <br><input type="text" name="input"><br>
            <br><button class='btn btn-info text-light' id="button" role='button' >Acceder à la liste</button></form>
            END;

        } else {
            $userName=$_SESSION['profile']['username'];
            $tab_v = ControlleurListes::toutListes();
            foreach($tab_v as $it){
                if($it->user_id == $idUser){
                    $url2 = $this->c->router->pathFor( 'listeUnite', ['no'=> $it->token]);
                    $url3 = $this->c->router->pathFor('Modification',['no'=> $it->token]);
                    $ph = "<a class='link-info m-2' href='".$url2."'> " . $it->titre ."</a>
                            <a >token : $it->token</a>
                            <a class='link-info' href='".$url3."'>modifier la liste</a><br>";
                }
            }
            $res = <<<END
            <h1>Bonjour $userName</h1>
            <h2>Vos listes :</h2>
            <p>
            $ph
            </p>
            <h2>Accès à une liste privée</h2>
            <p>Veuillez entrer le token de la liste privé dont vous voulez accéder</p>
            <form method="post" action="$url">
            <br><input type="text" name="input"><br>
            <br><button class='btn btn-info text-light' id="button" role='button' type="submit">Acceder à la liste</button></form>
            END;
        }
        return($vue->getNav().$res.$vue->getFooter());
    }
}