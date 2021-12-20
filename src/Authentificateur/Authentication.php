<?php
namespace wishlist\Authentificateur;


use MongoDB\Driver\Exception\AuthenticationException;
use wishlist\Authentificateur\Uttilisateur;
use PDO;

class Authentication{

    private static PDO $connexion;
    private static Uttilisateur $utilisateur;

    static function init(){
        $tab = parse_ini_file("src/Config/dbconfig.ini");
        $dsn = $tab['driver'].":host=".$tab['host'].";dbname=".$tab['database'];
        echo $dsn."<br>";
        self::$connexion = new PDO($dsn,$tab['username'],$tab['password'],array( PDO::ATTR_PERSISTENT => true,
                                                                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                                        PDO::ATTR_EMULATE_PREPARES  => false,
                                                                        PDO::ATTR_STRINGIFY_FETCHES => false));
        self::$connexion->prepare('SET NAMES \'UTF8\'')->execute();
    }

    public static function createUser( String $username, String $password){
        if(strlen($password) >= 10){
            $pass = hash('md5',$password,false);
            try {
                $query = "INSERT INTO users (username , passwd) VALUES (:username,:passwd)";
                self::$connexion->prepare($query)->execute([':username' => $username, ':passwd' => $pass]);
            }catch (\Exception $e){
                echo $e;
            }
        }
    }

    public static function authenticate($user,$password){
        $pass = hash('md5',$password,false);
        $query = "Select uid,username from users where username = ? and passwd = ?";
        $st = self::$connexion->prepare($query);
        $st->execute([$user,$pass]);
        if($st != null){
            while($row = $st->fetch(PDO::FETCH_ASSOC)){
                self::$utilisateur = new Uttilisateur($row['username'],$row['uid']);
                self::loadProfile($row['uid']);
            }
        }else{
                throw new AuthenticationException();
        }
    }

    private static function loadProfile($userid){
        $array = array('username :' => self::$utilisateur->nom, 'userid' => $userid, 'userip'=>$_SERVER['REMOTE_ADDR'],'roleid'=>1,'auth-level'=>1);
        unset($_SESSION['profile']);
        $_SESSION['profile'] = $array;
    }

    public static function checkAcessRight($requiredlevel){
        if($_SESSION['profile']['auth-level']<$requiredlevel){
            throw new AuthenticationException();
        }
    }

}