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

        $vue = new VueHTML($this->c);


        return($vue->getNav().<<<END
                        <body>
                                <h1>Exemple de listes</h1>
                                
                                <p>$ph</p>
                                
                                <p><a class='btn btn-outline-dark text-light' href="$tabUrl[1]" role='button'>Voir un exemple de liste</a></p>
                        </body>
                     </html>
                     END.$vue->getFooter());
    }
}