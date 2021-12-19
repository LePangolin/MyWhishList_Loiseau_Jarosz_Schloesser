<?php
namespace wishlist\Controlleur;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use wishlist\Vue\VueHome;

class ControlleurHome{
    private $c ; //container

    public function __construct(\Slim\Container $c){
        $this->c=$c;
    }

    public function welcome(Request $request, Response $response, array $array){
        $vue = new VueHome($this->c);
        return $vue->afficherAccueil();
    }
}