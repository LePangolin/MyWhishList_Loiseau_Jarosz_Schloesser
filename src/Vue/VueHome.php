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
                <header class="bg-secondary py-1 bg-opacity-40">
                    <div class="container px-2 px-lg-5 my-5">
                        <div class="text-center text-dark">
                            <h1 class="display-4 fw-bolder">MyWishList</h1>
                            <p class="lead fw-normal text-dark mb-0">La meilleure application web pour la gestion de listes de cadeaux</p>
                            <a class="btn btn-outline-dark text-light" href="$urlListe" role="button">Voirs les listes publiques</a>
                    </div>
                </div>
            </header>
            END
        .$vue->getFooter());
    }
}