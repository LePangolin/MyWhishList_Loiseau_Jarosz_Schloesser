<?php

namespace wishlist\Vue;

use Slim\Container;

class VueListeCreation
{
    private Container $container;
    public function __construct(Container $c){
        $this->container=$c;
}

    function afficher(){
        $vue = new VueHTML($this->container);
        return ($vue->getNav().
            <<<END
            <!--
                <!DOCTYPE html>
                    <html>
                <header class="bg-secondary py-1 bg-opacity-40">
                    <meta charset=\"UTF-8\">
                            <title>Création Liste</title>
                </header>
                <body>
                    <div>
                    <input type="text" placeholder="Nom de la nouvelle Liste" id="titre">
                    <input type="text" placeholder="Courte description de la Liste" id="description">
                    <input type="text" placeholder="Date de fin de la Liste" id="expiration">
                    <button type="button" onclick="getValues();">Créer ma nouvelle liste !</button>
                </div>
                <script>
                    function getValues(){
                        var titre = document.getElementsById("titre");
                        var description = document.getElementsById("titre");
                        var expiration = document.getElementsById("titre");
                        
                        alert(titre);
                        alert(description);
                        alert(expiration);
                    }
                </script>
                </body>
            </html>
            -->
            <!DOCTYPE html>
                    <html>
                <header class="bg-secondary py-1 bg-opacity-40">
                    <meta charset=\"UTF-8\">
                            <title>Création Liste</title>
                </header> 
                <form>
                  <p><br></p>
                  <label>Nom de la liste</label>
                  <input class="form-control-sm" id="titre" placeholder="Entrez le nom de la liste">
                  <p></p>
                  <label>Description</label>
                  <input class="form-control-sm" id="descr" placeholder="Description de la liste">
                  <p></p>
                  <label>Date d'expiration</label>
                  <input type="date" id="date">
                  <p></p>
                  <button type="button" onclick="getValues();">Créer ma nouvelle liste !</button>

                </form>
                <script>
                    function getValues(){
                        var titre = document.getElementsById("titre");
                        var description = document.getElementsById("descr");
                        var expiration = document.getElementsById("date");
                        
                        alert(titre);
                        alert(description);
                        alert(expiration);
                    }
                </script>
                </html>
            END
        .$vue->getFooter());
    }

}