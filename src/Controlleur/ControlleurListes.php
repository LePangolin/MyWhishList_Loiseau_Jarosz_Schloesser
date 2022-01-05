<?php
namespace wishlist\Controlleur;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Container;
use wishlist\Models\Liste as Liste;
use wishlist\Vue\VueListeCreation;
use wishlist\Vue\VueListes;


class ControlleurListes{
    private Container $c;
    public function __construct($c){
        $this->c = $c;
    }

    static function toutListes(){
        return Liste::all();
    }

    function afficherListeUtilisateur(Request $request, Response $response, array $array){
        $vue = new VueListes($this->c);
        if(isset($_SESSION['profile']['userid'])){
            $idUser = $_SESSION['profile']['userid'];
        } else {
            $idUser = null;
        }
        return $vue->afficherPerso($idUser);
    }

    function afficherToutesListes(Request $request, Response $response, array $array){
        $vue = new VueListes($this->c);
        return $vue->afficher();
    }

    function afficherUneListe(Request $request, Response $response, array $array){
        $vue = new VueListes($this->c);
        return $vue->afficher($array['no']);
    }

    function creeListe(Request $request, Response $response, array $array){
        $vue = new VueListeCreation($this->c);
        return $vue->afficher();
    }

}
