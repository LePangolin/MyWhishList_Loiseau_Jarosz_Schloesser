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
                    <div class='row align-items-start w-100'>
                        <div class='col'>
                            <form method='get'>
                                <h1>Ajouter un item</h1>
                                <br>
                                <div class='mb-3'>
                                    <label class='form-label'>Nom de l'item</label>
                                </div>
                                <input type='text' name='nomIt'>
                                <br>
                                <br>
                                <div class='mb-3'>
                                    <label class='form-label'>Description de l'item</label>
                                </div>
                                <textarea name='descr'></textarea>
                                <br>
                                <br>
                                <div class='mb-3'>
                                    <label class='form-label'>image</label>
                                </div>
                                <input type='text' name='img'>
                                <br>
                                <br>
                                <div class='mb-3'>
                                    <label class='form-label'>url</label>
                                </div>
                                <input type='text' name='url'>
                                <br>
                                <br>
                                <input type='submit' name='submit'>
                            </form>
                        </div>
                    </div>";



        return(
          $vue->getNav()."<body>$ajoutIt</body>".$vue->getFooter()
        );
    }
}