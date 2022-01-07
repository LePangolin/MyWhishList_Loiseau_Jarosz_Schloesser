<?php
namespace wishlist\Vue;
use Slim\Container;
use wishlist\Authentificateur\Authentication;

class VueConnexion{
    private $c;

    public function __construct(Container $c){
        $this->c = $c;
    }

    public function afficherConnexion(){
        $vue = new VueHTML($this->c);
        $urlcreation = $this->c->router->pathfor("Creation de compte");
        $ph = "
                    <br><h1>Connexion</h1><br>   
                    <form action='' method='get'>
                    <label>Nom Utilisateur :</label><input type='text' name='nom'>
                    <br><p></p>
                    <label>Mot de Passe :</label><input type='password' name = 'mdp'>
                    <p></p>
                    <input type='submit' name='submit'>
                    </form>";

        if(isset($_GET['submit'])){
            $nom = $_GET['nom'];
            $mdp = $_GET['mdp'];
            Authentication::init();
            Authentication::authenticate($nom,$mdp);
        }
        return(
            $vue->getNav()."
                        <body>
                           $ph
                           <p></p><a class='btn btn-outline-dark text-light' href=$urlcreation role=button>Vous n'avez pas de compte ?</a>
                        </body>
                     ".$vue->getFooter()
        );
    }

    public function creerUnCompte(){
        $vue = new VueHTML($this->c);
        $urlcreation = $this->c->router->pathfor("Connexion");
        $ph = "
        <br><h1>Créer un compte</h1><br>   
                    <form>
                    <label>Nom Utilisateur :</label>
                    <input>
                    <br><p></p>
                    <label>Mot de Passe :</label>
                    <input type='password'>
                    <p></p>
                    <button>Créer un compte</button>
                    </form>";
        return(
            $vue->getNav()."
                        <body>
                           $ph
                           <p></p><a class='btn btn-outline-dark text-light' href=$urlcreation role=button>Vous avez déjà un compte ?</a>
                        </body>
                     ".$vue->getFooter()
        );
    }
}