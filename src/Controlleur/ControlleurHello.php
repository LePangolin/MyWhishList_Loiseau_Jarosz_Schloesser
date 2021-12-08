<?php
namespace src\Controlleur;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControlleurHello{
    private $c ;

    public function __construct(\Slim\Container $c){
        $this->c=$c;
    }

    public function sayHello(Request $request, Response $response, array $array): Response{
        $name= $array['name'];
        $response -> getBody() -> write("Hello, $name");
        return  $response;
    }
}