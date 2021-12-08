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
            1 => "/hello/diego",
            2 => "/hello/mama",
            3 => "/hello/dadi",
            4 => "/hello/sista"
        );

        $html="<h1> Accueil du site WishList</h1>";
        $html .= '<p><a href="$tabUrl[1]" </p>';

        $response->getBody()->write($html);
        return  $response;
    }
}