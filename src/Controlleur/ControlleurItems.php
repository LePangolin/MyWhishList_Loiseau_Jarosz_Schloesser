<?php
namespace wishlist\Controlleur;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Container;
use wishlist\Models\Item as Items;
use wishlist\Vue\VueItems;


class ControlleurItems{
    private Container $c;
    public function __construct(Container $c){
        $this->c = $c;
    }

    static function toutItems(){
        return Items::all();
    }

    function afficherToutItem(Request $request, Response $response, array $array): string{
        $vue = new VueItems($this->c);
        return $vue->afficherToutItem();
    }

    function afficherUnItem(Request $request, Response $response, array $array): string{
        $id = $array['id'];
        $vue = new VueItems($this->c);
        return $vue->afficherToutItem($id);
    }
}
