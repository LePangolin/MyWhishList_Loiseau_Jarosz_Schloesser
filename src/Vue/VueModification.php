<?php

namespace wishlist\Vue;

use \Psr\Http\Message\ResponseInterface as Response;
use PDO;
use Slim\Container;
use wishlist\Authentificateur\Authentication;

class VueModification{

    private Container $c;

    function __construct(Container $c){
        $this->c = $c;
    }

    function modification(Response $response){
        $vue = new VueHTML($this->c);
        if (isset($_SESSION['profile'])){
            $php = '
                    <br>
                    <br>
                    <div class="row align-items-start">
                    <div class="col">
                        <h1>Modifier votre mot de passe</h1>
                        <br>
                        <form method="get">
                        <div class="mb-3">
                            <label class="form-label">Ancien mot de passe : </label>
                        </div>
                            <input type="password" name="ancien">
                            <br>
                            <br>
                        <div class="mb-3">
                            <label class="form-label">Nouveau Mot de Passe : </label>
                        </div>
                            <input type="password" name="nouveau1">
                            <br>
                            <br>
                        <div class="mb-3">
                            <label>Confirmer nouveau : </label>
                        </div>
                            <input type="password" name="nouveau2">
                            <br>
                            <br>
                            <input type="submit" name="submit" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="col">
                    <h1>Supprimer votre compte</h1>
                    <br>
                    <form action= "" method="get">
                    <div class="mb-3">
                        <label class="form-label">Nom : </label>
                    </div>
                        <input type="text" name="name">
                        <br>
                        <br>
                    <div class="mb-3">
                        <label>Mot de Passe : </label>
                    </div>
                        <input type="password" name="mdp">
                        <br>
                        <br>
                    <div class="mb-3"
                        <label>Confirmer: </label>
                    </div>
                        <input type="password" name="mdpConf">
                        <br>
                        <br>
                        <input type="submit" name="suppr" class="btn btn-primary">
                    </form>
                    </div>
                    </div>
            ';

            if(isset($_GET['submit'])){
                Authentication::init();
                $ancien = hash('md5',$_GET['ancien'],false);
                $nouveau1  = hash('md5',$_GET['nouveau1']);
                $nouveau2  = hash('md5',$_GET['nouveau2']);
                $pdo =  Authentication::$connexion;
                $query = 'Select passwd from users where uid = ?';
                $st = $pdo->prepare($query);
                $st->execute([$_SESSION['profile']['userid']]);
                $row = $st->fetch(PDO::FETCH_ASSOC);
                if($ancien != $row['passwd']){
                    echo "<script>alert(\"L'ancien mot de passe ne correspond pas\")</script>";
                }
                else if($nouveau1 != $nouveau2){
                    echo "<script>alert(\"Les deux nouveau mots de passe ne correspondent pas\")</script>";
                }
                else if(strlen($_GET['nouveau1']) < 10){
                    echo "<script>alert(\"Le mot de passe est trop court\")</script>";
                }
                else{
                    $query1 = "Update users set passwd = ? where uid = ?";
                    $st1 = $pdo->prepare($query1);
                    $st1->execute([$nouveau1,$_SESSION['profile']['userid']]);
                    unset($_SESSION['profile']);
                    echo "<script>alert(\"Vous devez vous reconnecter\")</script>";
                }

            }else if(isset($_GET['suppr'])){
                Authentication::init();
                $name = $_GET['name'];
                $mdp  = hash('md5',$_GET['mdp']);
                $mdpConf  = hash('md5',$_GET['mdpConf']);
                $pdo =  Authentication::$connexion;
                $query2 = 'Select passwd from users where uid = ?';
                $st2 = $pdo->prepare($query2);
                $st2->execute([$_SESSION['profile']['userid']]);
                $row = $st2->fetch(PDO::FETCH_ASSOC);
                if($mdp != $row['passwd']){
                    echo "<script>alert(\"L'ancien mot de passe ne correspond pas\")</script>";
                }
                else if($mdp != $mdpConf){
                    echo "<script>alert(\"Les deux nouveau mots de passe ne correspondent pas\")</script>";
                }else{
                    $query3 = "Delete from users where uid = ?";
                    $pdo->prepare($query3)->execute([$_SESSION['profile']['userid']]);
                    echo "<script>alert(\"Votre compte a bien été supprimer\")</script>";
                    unset($_SESSION['profile']);
                    return(
                        $response->withRedirect($this->c->router->pathfor('home'))
                    );
                }

            }
        }else{
            $php = "<p>Vous devez être connecter</p>";
        }

        return(
            $vue->getNav()."<body>$php</body>".$vue->getFooter()
        );
    }
}
