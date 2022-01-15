<?php
namespace wishlist\Controlleur;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Container;
use wishlist\Models\Item as Items;
use wishlist\Models\Reservation as Reservation;
use wishlist\Vue\VueItems;
use wishlist\Vue\VueReservation;


class ControlleurItems{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    static function toutItems(){
        return Items::all();
    }

    static function toutReservation(){
        return Reservation::all();
    }

    function afficherToutItem(Request $request, Response $response, array $array): string{
        $vue = new VueItems($this->c);
        return $vue->afficherItem();
    }

    function afficherUnItem(Request $request, Response $response, array $array): string{
        $id = $array['id'];
        $no = $array['no'];
        $vue = new VueItems($this->c);
        return $vue->afficherItem($id, $no);
    }

    function afficherReservation(Request $request, Response $response, array $array): string{
        $vue = new VueReservation($this->c);
        return $vue->afficher($array['id']);
    }
}
