<?php
namespace wishlist\Controlleur;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Container;
use wishlist\Vue\VueConnexion;

class ControlleurConnexion{
    private $c;

    public function __construct(Container $c){
        $this->c = $c;
    }

    public function connexion(Request $request, Response $response, array $array){
        $vue = new VueConnexion($this->c);
        return $vue->afficherConnexion();
    }

    public function creerUnCompte(Request $request, Response $response, array $array){
        $vue = new VueConnexion($this->c);
        return $vue->creerUnCompte();
    }
}
