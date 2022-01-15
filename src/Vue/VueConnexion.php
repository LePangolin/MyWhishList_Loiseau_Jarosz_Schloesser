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

    /** Méthode qui permet de afficher la page html correspondant
     * à la page de connexion au site, grâce à un utilisateur
     * @param Response $response
     * @return Response|string
     */
    public function afficherConnexion(Response $response){
        $vue = new VueHTML($this->c);
        $urlcreation = $this->c->router->pathfor("Creation de compte");
        if(!isset($_SESSION['profile'])) {
            $ph = "
                    <br><h1>Connexion</h1><br>
                    <div class='container'>
                        <form action='' method='get'>
                        <div class='mb-3'>
                            <label class='form-label'>Nom Utilisateur : </label>
                        </div>
                        <input type='text' name='nom'><br><br>
                        <div class='mb-3'>    
                            <label class=''>Mot de Passe : </label>
                        </div>
                        <input type='password' name = 'mdp'>
                        <br>
                        <br>
                        <input type='submit' name='submit' class='btn btn-primary'>
                        </form>
                    </div>
                    <p></p><a class='btn btn-info text-light' href=$urlcreation role=button>Vous n'avez pas de compte ?</a>";
        //Lorsque l'on submit on récupère le nom d'utilisateur et le mdp puis on procède à une authentification
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

    /** Méthode qui permet d'afficher la page de création d'un compte, grâce à un nom et un mdp
     * @param Response $response
     * @return Response|string
     */
    public function creerUnCompte(Response $response){
            $er="";
            $vue = new VueHTML($this->c);
            $urlcreation = $this->c->router->pathfor("Connexion");
        //Si aucun utilisateur est connecter sur la session alors il peut créer un compte
            if(!isset($_SESSION['profile'])){
                $ph = "
                <br><h1>Créer un compte</h1><br>   
                <div class='container'>
                    <form method='get'>
                    <div class='mb-3'>
                        <label class='form-label'>Nom Utilisateur :</label> 
                    </div>    
                        <input type='text' name='name'>
                     <div class='mb-3'>
                     <br>
                        <label>Mot de Passe :</label>
                     </div>
                        <input type='password' name='pswd'>
                        <br>
                        <br>
                        <input type='submit' name='submit' class='btn btn-primary'>
                     </form>
                </div>
                
                <p></p><a class='btn btn-info text-light' href=$urlcreation role=button>Vous avez déjà un compte ?</a>";
            //Si on submit on récupère le mdp et le nom d'utilisateur, on regarde si le mdp convient
                if (isset($_GET['submit'])) {
                    $name = $_GET['name'];
                    $pswd = $_GET['pswd'];
                    if(strlen($pswd) < 10){
                        $er="<p>Attention : Mot de passe trop court !</p>";
                    }else{
                        Authentication::init();
                        Authentication::createUser($name, $pswd);
                        Authentication::authenticate($name, $pswd);
                        return(
                        $response->withRedirect($this->c->router->pathfor('home'))
                        );
                    }
                }
        }else{
            $nom = $_SESSION['profile']['username'];
            $ph = "<p>Vous êtes déjà connecter en temps que $nom</p>";
        }
        return(

            $vue->getNav()."
                        <body>
                           $ph.
                           $er
                        </body>
                     ".$vue->getFooter()
        );
    }

    /** Méthode qui permet de déconnecter un uti de la session
     * @return string
     */
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