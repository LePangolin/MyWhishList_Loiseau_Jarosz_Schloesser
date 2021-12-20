<?php
namespace wishlist\Authentificateur;

class Uttilisateur{

    private int $id;
    private String $nom;
    private int $roleid;
    private int $authlevel;


    function __construct($name,$id){
        $this->nom = $name;
        $this->id = $id;
        $this->roleid = 1;
        $this->authlevel =1;
    }
    function __set(String $name, mixed $value){
        $this->$name = $value;
    }

    function __get(String $name){
        return $this->$name;
    }
}