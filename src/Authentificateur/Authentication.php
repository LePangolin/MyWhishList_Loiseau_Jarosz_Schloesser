<?php
namespace whishlist\Authentificateur;


use MongoDB\Driver\Exception\AuthenticationException;
use wishlist\Authentificateur\Uttilisateur;
use PDO;

class Authentication{

    private static PDO $connexion;
    private static Uttilisateur $utilisateur;

    function __construct(){
        $tab = parse_ini_file("../Config/dbconfig.ini");
        $dsn = $tab['driver'].":host".$tab['host']."dbname:".$tab['database'];
        self::$connexion = new PDO($dsn,$tab['user'],$tab['mdp'],array( PDO::ATTR_PERSISTENT => true,
                                                                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                                        PDO::ATTR_EMULATE_PREPARES  => false,
                                                                        PDO::ATTR_STRINGIFY_FETCHES => false));
        self::$connexion->prepare('SET NAMES \'UTF8\'')->execute();
    }

    public static function createUser( String $username, String $password){
        if(strlen($password) > 10){
            $pass = hash('md5',$password,false);
            $query = "INSERT INTO users VALUES [username , passwd] VALUES $username, $pass";
            self::$connexion->prepare($query)->execute();
        }
    }

    public static function authenticate($user,$password){
        $pass = hash('md5',$password,false);
        $query = "Select count(*) as nb, uid,username from users where username = $user and $pass";
        $st = self::$connexion->prepare($query)->execute();
        while($row = $st->fetch(PDO::FETCH_ASSOC)){
            if ($row['nb'] = 0){
                self::$utilisateur->nom = $row['username'];
                self::$utilisateur->id =$row['uid'];
                self::loadProfile($row['uid']);
            }else{
                throw new AuthenticationException();
            }
        }
    }

    private static function loadProfile($userid){
        $array = array('username :' => self::$utilisateur->nom, 'userid' => $userid, 'userip'=>$_SERVER['REMOTE_ADDR'],'roleid'=>self::$utilisateur->roleid,'auth-level'=>self::$utilisateur->authlevel);
        unset($_SESSION['profile']);
        $_SESSION['profile'] = $array;
    }

    public static function checkAcessRight($requiredlevel){
        if($_SESSION['profile']['auth-level']<$requiredlevel){
            throw new AuthenticationException();
        }
    }

}