<?php
namespace wishlist\Vue;

use Slim\Container;
use wishlist\Controlleur\ControlleurListes as ControlleurListes;

class VueListes{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    function afficherToutesListes(){
        $tab_v = ControlleurListes::toutListes();
        $ph = "";

        $tabUrl = array(
            1=>$this->c->router->pathFor("home")
        );
        foreach($tab_v as $it){
            $ph.= $it->no." : ".$it->titre."<br>";
        }



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