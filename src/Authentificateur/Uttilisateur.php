<?php
namespace wishlist\Authentificateur;

class Uttilisateur{

    private int $id;
    private String $nom;
    private int $roleid;
    private int $authlevel;

    function __set(String $name, mixed $value){
        $this->$name = $value;
    }

    function __get(String $name){
        return $this->$name;
    }
}