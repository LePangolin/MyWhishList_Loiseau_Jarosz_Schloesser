<?php
namespace wishlist\Controlleur;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Container;
use wishlist\Vue\VueConnexion;
use wishlist\Vue\VueModification;

class ControlleurModification{

    private $c;
    function __construct(Container $c){
        $this->c = $c;
    }

    public function modifierMotDePasse(Request $request, Response $response, array $array){
        $vue = new VueModification($this->c);
        return $vue->modification($response);

    }
}