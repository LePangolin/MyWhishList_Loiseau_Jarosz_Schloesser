<?php
namespace wishlist\Vue;
use Slim\Container;

/**
 * Cette Vue est utilisée par toutes les autres vues car elle possède le code HTML de la barre de navigation
 * et le footer, cette classe a été créée pour éviter de dupliquer le code
 */

class VueHTML{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    public function getNav():string{
        return
            '
            <!doctype html>
            <html lang="fr">
            <head>
                <!-- Tags meta obligatoires -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
            
                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            
                <title>MyWishList</title>
                <style>
                    
                    body {
                        margin: 0;
                        min-height: 100vh;
                        display: grid;
                        grid-template-rows: auto 1fr auto;
                        text-align: center;
                    }
                    
                </style>
            </head>
            
            <body class="bg-secondary">
            <!-- Barre de Navigation -->
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <div class="container px-0 px-lg-0">
                    <a class="navbar-brand" href="http://localhost/MyWishList_Jarosz_Loiseau_Schloesser/">MyWishList</a>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <li class="nav-item"><a class="nav-link " href="#!">Créer une liste</a></li>
                            <li class="nav-item"><a class="nav-link " href="#!">Mes listes</a></li>
                            <li class="nav-item"><a class="nav-link " href="#!">Comment ça marche ?</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mon Compte</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#!">Connexion</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#!">Créer un comte</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <main><!--Contient le contenu de nos requêtes-->
            ';
    }

    public function getFooter(): string{
        return
        <<<END
            </main>
            <!-- Option 1: Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            
            <!-- Footer : aubout us + Fonctionnalités réalisées -->
            <footer class="py-1 bg-dark text-center">
                <button type="button" class="btn btn-outline-secondary">A propos de nous</button>
                <button type="button" class="btn btn-outline-secondary">Fonctionnalitées réalisées</button>
                <div class="container"><p class="m-0 text-center text-white">Copyright &copy; JLS</p></div>
            </footer>
            </body>
            </html>
        END;
    }

}