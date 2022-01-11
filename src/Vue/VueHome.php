<?php
namespace wishlist\Vue;
use Slim\Container;
class VueHome{
    private Container $container;
    public function __construct(Container $c){
        $this->container=$c;
    }

    function afficherAccueil(){
        $vue = new VueHTML($this->container);
        $urlListe = $this->container->router->pathFor("listeAll");
        return ($vue->getNav().
            <<<END
                <header class="bg py-1 bg-opacity-40">
                    <div class="container px-2 px-lg-5 my-5">
                        <div class="text-center text-dark">
                            <h1 class="display-4 fw-bolder">MyWishList</h1>
                            <p></p>
                            <p class="lead fw-normal text-dark mb-0">La meilleure application web pour la gestion de listes de cadeaux</p>
                            <p></p><a class="btn btn-info text-light" href="$urlListe" role="button">Voirs les listes publiques</a>
                    </div>
                </div>
            </header>
            END
        .$vue->getFooter());
    }

    function afficherTuto(){
        $vue = new VueHTML($this->container);
        $urlListe = $this->container->router->pathFor("listeAll");
        return ($vue->getNav().
            <<<END
                <br><p></p>
                <h1>Comment utiliser MyWishList ?</h1>
                <div class="container px-2 px-lg-5 my-5">
                <p>MyWishList est une application web de gestion de liste de cadeaux.<br>
                Vous pouvez créer une liste à partir du button "Créer une Liste".<br>
                Il est aussi possible de consulter des listes publiques avec le button si-dessous<br>
                Tout le monde peut participer à une liste tant que vous avez le token de la dite liste accessible dans l'onglet "Mes Listes"</p>
                <a class="btn btn-info text-light" href="$urlListe" role="button">Voirs les listes publiques</a>
                </div>
            END
            .$vue->getFooter());
    }

    function afficherNosInfos(){
        $vue = new VueHTML($this->container);
        return ($vue->getNav().
            <<<END
                <br><p></p>
                <h1>A propos de nous</h1>
                <div class="container px-2 px-lg-5 my-5">
                <p>Bonjour, nous sommes les auteurs de cette application web<br>
                Nous sommes en actuellement en 2ème année de DUT Informatique à l'IUT Nancy Charlemagne<br>
                Cette application a été réalisée dans le cadre d'un projet scolaire.<br>
                
                </div>
            END
            .$vue->getFooter());
    }

    function afficherFonctionnalites(){
        $vue = new VueHTML($this->container);
        return ($vue->getNav().
            <<<END
                <br><p></p>
                <h1>Fonctionnalités réalisées</h1>
                <div class="container px-2 px-lg-5 my-5">
                <p>Page non finie</p>
                </div>
            END
            .$vue->getFooter());
    }
}