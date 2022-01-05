<?php
namespace wishlist\Vue;
use Slim\Container;

class VueConnexion{
    private $c;

    public function __construct(Container $c){
        $this->c = $c;
    }

    public function afficherConnexion(){
        $vue = new VueHTML($this->c);
        $urlListe = $this->c->router->pathfor("Connexion");
        $ph = "<form>
                    <label>Nom Uttilisateur :</label>
                    <input type='submit'>
                    <br>
                    <label>Mot de Passe :</label>
                    <input type='password'>
                    <br>
                    <button>Se connecter</button>
               </form>";
        return(
            $vue->getNav()."<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset=\"UTF-8\">
                            <title>Connexion</title>
                        </head> 
                        <body>
                           $ph
                           <a class='btn btn-outline-dark text-light' href=$urlListe[1] role=button>Retour à la liste</a>
                        </body>
                     </html>".$vue->getFooter()
        );
    }
}