<?php

namespace wishlist\Vue;

use Slim\Container;
use PDO;
use wishlist\Authentificateur\Authentication;

class VueReservation
{
    private Container $container;

    public function __construct(Container $c)
    {
        $this->container = $c;
    }

    function afficher($id){
        $vue = new VueHTML($this->container);


        if(isset($_SESSION['profile'])){
            $php = '<!DOCTYPE html>
                        <html>
                    <header class="bg-secondary py-1 bg-opacity-40">
                        <meta charset=\"UTF-8\">
                                <title>Création Liste</title>
                    </header> 
                    <form action="" method="get">  
                      <p><br></p>
                      <h1> Réservation </h1>
                      <p><br></p>
                      <label>Nom :</label>
                      <input class="form-control-sm" name="nom">
                      <p></p>
                      <label>Message :</label>
                      <input class="form-control-sm" name="commentaire">
                      <p></p>
                      <button type="submit" name="valider">'."Réserver l'item !</button>
                    </form>
                    </html>";
            if(isset($_GET['valider'])){
                Authentication::init();

                $pdo = Authentication::$connexion;
                $sqlQuery = 'SELECT MAX(idreservation) as \'idreservation\' FROM reservation ';
                $insertRecipe = $pdo->prepare($sqlQuery);

                $insertRecipe->execute();
                $row = $insertRecipe->fetch(PDO::FETCH_ASSOC);

                $idreserv = $row['idreservation'];
                $idreserv ++;
                $sqlQuery = 'INSERT INTO reservation(idreservation, userid, nom, commentaire, iditem)  
                VALUES (:idreservation, :userid, :nom, :commentaire, :iditem)';

                $insertRecipe = $pdo->prepare($sqlQuery);
                $insertRecipe->execute([
                    'idreservation' => $idreserv,
                    'userid' => $_SESSION['profile']['userid'],
                    'nom' => htmlspecialchars($_GET['nom']),
                    'commentaire' => htmlspecialchars($_GET['commentaire']),
                    'iditem' => htmlspecialchars($id)
                ]);

                $php.="<p>L'item est bien réservé ! </p>";

            }
        }else{
            $php = "<p>Vous devez être connecter pour réservé un item</p>";
        }
        return ($vue->getNav(). $php . $vue->getFooter());
    }
}