<?php
namespace wishlist\Controlleur;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControlleurHome{
    private $c ;

    public function __construct(\Slim\Container $c){
        $this->c=$c;
    }

    public function welcome(Request $request, Response $response, array $array): Response{

        $tabUrl = array(
            1 => $this->c->router->pathFor("hello", ["name"=>"diego"])
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
            <p><a href=$tabUrl[1]>Diego</a></p>
            </body>
            </html>
        END;

        $response->getBody()->write($html);
        return  $response;
    }
}