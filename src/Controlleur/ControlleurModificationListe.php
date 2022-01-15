<?php
namespace wishlist\Controlleur;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Container;
use wishlist\Models\Liste as Liste;
use wishlist\Vue\VueListeCreation;
use wishlist\Vue\VueListes;
use wishlist\Vue\VueModificationListe;

class ControlleurModificationListe{

    private Container $c;

    function __construct($c){
        $this->c = $c;
    }

    function ajout(Request $request, Response $response, array $array){
        $vue = new VueModificationListe($this->c);
        return $vue->ajout($response,$array['no']);
    }
}
