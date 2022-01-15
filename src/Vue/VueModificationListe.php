<?php
namespace wishlist\Vue;

use Slim\Container;
use wishlist\Authentificateur\Authentication;
use wishlist\Controlleur\ControlleurItems;
use wishlist\Controlleur\ControlleurListes;

class VueModificationListe{


    private Container $c;

    public function __construct(Container $c)
    {
        $this->c = $c;
    }

    function ajout($token = null){
        $vue = new VueHTML($this->c);
        $ajoutIt = "<br>
                    <br>
                    <div class='row align-items-start'>
                        <div class='col'>
                            <form>
                                <div class='mb-3'>
                                    <label class='form-label'>Nom de l'item</label>
                                </div>
                                <input type='text' name='nomIt'>
                                <br>
                                <br>
                                $token
                            </form>
                        </div>
                    </div>";

        return(
          $vue->getNav()."<body>$ajoutIt</body>".$vue->getFooter()
        );
    }
}