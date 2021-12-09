<?php
namespace wishlist\Controlleur;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControlleurHome{
    private $c ; //container

    public function __construct(\Slim\Container $c){
        $this->c=$c;
    }

    public function welcome(Request $request, Response $response, array $array): Response{

        $tabUrl = array(
            1 => $this->c->router->pathFor("hello", ["name"=>"Lucas"]),
            2 => $this->c->router->pathFor("listeAll"),
            3 => $this->c->router->pathFor("item")
        );

        $html= <<<END
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>MyWishList</title>
            </head>
            <body>
            <h1> Accueil du site WishList</h1>
            <p><a href=$tabUrl[1]>Lucas </a></p>
            <p><a href=$tabUrl[2]>Afficher les listes</a></p>
            <p><a href=$tabUrl[3]>Afficher les items</a></p>
            </body>
            </html>
        END;

        $response->getBody()->write($html);
        return  $response;
    }
}