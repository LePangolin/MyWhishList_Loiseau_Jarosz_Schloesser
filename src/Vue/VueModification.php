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
                    <p>Modifier votre mot de passe</p>
                    <br>
                    <form method="get">
                        <label>Ancien mot de passe : </label><input type="password" name="ancien">
                        <label>Nouveau Mot de Passe : </label><input type="password" name="nouveau1">
                        <label>Confirmer nouveau : </label><input type="password" name="nouveau2">
                        <input type="submit" name="submit">
                    </form>
                    <br>
                    <br>
                    <br>
                    <p>Supprimer votre compte</p>
                    <br>
                    <form action= "" method="get">
                        <label>Nom : </label><input type="text" name="name">
                        <label>Mot de Passe : </label><input type="password" name="mdp">
                        <label>Confirmer: </label><input type="password" name="mdpConf">
                        <input type="submit" name="suppr">
                    </form>
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
