<?php
namespace wishlist\Vue;
use Slim\Container;
use Slim\Http\Response;
use wishlist\Authentificateur\Authentication;

class VueConnexion{
    private $c;

    public function __construct(Container $c){
        $this->c = $c;
    }

    public function afficherConnexion(Response $response){
        $vue = new VueHTML($this->c);
        $urlcreation = $this->c->router->pathfor("Creation de compte");
        if(!isset($_SESSION['profile'])) {
            $ph = "
                    <br><h1>Connexion</h1><br>   
                    <form action='' method='get'>
                    <label>Nom Utilisateur :</label><input type='text' name='nom'>
                    <br><p></p>
                    <label>Mot de Passe :</label><input type='password' name = 'mdp'>
                    <p></p>
                    <input type='submit' name='submit'>
                    </form>
                    <p></p><a class='btn btn-info text-light' href=$urlcreation role=button>Vous n'avez pas de compte ?</a>";

            if (isset($_GET['submit'])) {
                $nom = $_GET['nom'];
                $mdp = $_GET['mdp'];
                Authentication::init();
                Authentication::authenticate($nom, $mdp);
                return(
                    $response->withRedirect($this->c->router->pathfor('home'))
                );
            }
        }else{
            $nom = $_SESSION['profile']['username'];
            $ph = "<p>Vous êtes déjà connecter en temps que $nom</p>";
        }

        return(
            $vue->getNav()."
                        <body>
                           $ph
                        </body>
                     ".$vue->getFooter()
        );
    }

    public function creerUnCompte(Response $response){
            $vue = new VueHTML($this->c);
            $urlcreation = $this->c->router->pathfor("Connexion");
            if(!isset($_SESSION['profile'])){
                $ph = "
                <br><h1>Créer un compte</h1><br>   
                <form method='get'>
                <label>Nom Utilisateur :</label> <input type='text' name='name'>
                <br><p></p>
                <label>Mot de Passe :</label><input type='password' name='pswd'>
                <p></p>
                <input type='submit' name='submit'>
                </form>
                <p></p><a class='btn btn-info text-light' href=$urlcreation role=button>Vous avez déjà un compte ?</a>";
                if (isset($_GET['submit'])) {
                    $name = $_GET['name'];
                    $pswd = $_GET['pswd'];
                    Authentication::init();
                    Authentication::createUser($name, $pswd);
                    Authentication::authenticate($name, $pswd);
                    return(
                    $response->withRedirect($this->c->router->pathfor('home'))
                    );
                }
        }else{
            $nom = $_SESSION['profile']['username'];
            $ph = "<p>Vous êtes déjà connecter en temps que $nom</p>";
        }
        return(

            $vue->getNav()."
                        <body>
                           $ph
                        </body>
                     ".$vue->getFooter()
        );
    }

    public function deconnexion(){
        $vue = new VueHTML($this->c);
        $urlcreation = $this->c->router->pathfor("Deconnexion");
        Authentication::deconnexion();
        return(
            $vue->getNav()."
                        <body>
                           <p>Vous avez bien été deconnecter</p>
                        </body>
                     ".$vue->getFooter()
        );
    }
}