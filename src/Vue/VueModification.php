<?php

namespace wishlist\Vue;

use PDO;
use Slim\Container;
use wishlist\Authentificateur\Authentication;

class VueModification{

    private Container $c;

    function __construct(Container $c){
        $this->c = $c;
    }

    function modification(){
        $vue = new VueHTML($this->c);
        if (isset($_SESSION['profile'])){
            $php = '
                    <form method="get">
                        <label>Ancien mot de passe : </label><input type="password" name="ancien"><br>
                        <label>Nouveau Mot de Passe : </label><input type="password" name="nouveau1"><br>
                        <label>Confirmer nouveau : </label><input type="password" name="nouveau2"><br>
                        <input type="submit" name="submit">
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
                else if(strlen($nouveau1) < 10){
                    echo "<script>alert(\"Le mot de passe est trop court\")</script>";
                }
                else{
                    $query1 = "Update users set passwd = ? where uid = ?";
                    $st1 = $pdo->prepare($query1);
                    $st1->execute([$nouveau1,$_SESSION['profile']['userid']]);
                    unset($_SESSION['profile']);
                    echo "<script>alert(\"Vous devez vous reconnecter\")</script>";
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
