<?php
namespace wishlist\Vue;

use Slim\Container;
use wishlist\Controlleur\ControlleurListes as ControlleurListes;

class VueListes{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    function afficher($no=null){
        $tab_v = ControlleurListes::toutListes();
        $ph = "";

        $tabUrl = array(
            1=>$this->c->router->pathFor("home"),
            2=>$this->c->router->pathFor("listeAll")
        );
        foreach($tab_v as $it){
            $url = $this->c->router->pathFor( 'listeUnite', ['no'=> $it->no] ) ;
            $ph.= "<a class='link-info' href='".$url."'> " . $it->no . " : " . $it->titre . "</a><br>";
        }

        $vue = new VueHTML($this->c);

        if($no==null){
            $res = <<<END
                        <body>
                                <h1>Exemple de listes</h1>
                                
                                <p>$ph</p>
                                
                                <p><a class='btn btn-outline-dark text-light' href="$tabUrl[1]" role='button'>Retour à l'accueil</a></p>
                        </body>
                     </html>
                     END;
        } else {
            $res = <<<END
                <h2>fonction non terminée<h2>
                <p><a class='btn btn-outline-dark text-light' href="$tabUrl[2]" role='button'>Voir un autre exemple de liste</a></p>
                <p><a class='btn btn-outline-dark text-light' href="$tabUrl[1]" role='button'>Retour à l'accueil</a></p>
                END;
        }

        return($vue->getNav().$res.$vue->getFooter());
    }
}