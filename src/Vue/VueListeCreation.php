<?php

namespace wishlist\Vue;

use Slim\Container;
use wishlist\Authentificateur\Authentication;

class VueListeCreation
{
    private Container $container;
    public function __construct(Container $c){
        $this->container=$c;
}

    function afficher(){
        $vue = new VueHTML($this->container);
        $php = '
            <!DOCTYPE html>
                    <html>
                <header class="bg-secondary py-1 bg-opacity-40">
                    <meta charset=\"UTF-8\">
                            <title>Création Liste</title>
                </header> 
                <form action="" method="get">  
                  <p><br></p>
                  <h1> Création de la liste </h1>
                  <p><br></p>
                  <label>Nom de la liste</label>
                  <input class="form-control-sm" name="titre" placeholder="Entrez le nom de la liste">
                  <p></p>
                  <label>Description</label>
                  <input class="form-control-sm" name="descr" placeholder="Description de la liste">
                  <p></p>
                  <label>Date d expiration</label>
                  <input type="date" name="date">
                  <p></p>
                  <button type="submit" name="valider">Créer ma nouvelle liste !</button>

                </form>
                </html>
            ';

        if (isset($_GET['submit'])) {
            Authentication::init();

            $pdo = Authentication::get("connexion");
            $sqlQuery = 'SELECT MAX(no) FROM liste ';
            $insertRecipe = $pdo->prepare($sqlQuery);

            $noliste = $insertRecipe->execute();
            $noliste ++;

            $sqlQuery = 'INSERT INTO personne(no, user_id, titre, description, expiration, token)  
            VALUES (:no, :user_id, :titre, :description, :expiration, :token)';

            $insertRecipe = $pdo->prepare($sqlQuery);
            $insertRecipe->execute([
                'no' => $noliste,
                'user_id' => 0,
                'titre' => htmlspecialchars($_GET['titre']),
                'description' => htmlspecialchars($_GET['descr']),
                'expiration' => htmlspecialchars($_GET['date']),
                'token' => "test1"
            ]);

        }

        return ($vue->getNav(). $php . $vue->getFooter());


    }

}