<?php
namespace wishlist\Vue;

use Psr\Http\Message\ResponseInterface as Response;
use PDO;
use Slim\Container;
use wishlist\Authentificateur\Authentication;
use wishlist\Controlleur\ControlleurItems;
use wishlist\Controlleur\ControlleurListes;

class VueModificationListe{


    private Container $c;

    public function __construct(Container $c)
    {
        $this->c = $c;
    }

    function ajout(Response $response, $token = null){
        $vue = new VueHTML($this->c);
        $ajoutIt = "<br>
                    <br>
                    <div class='row align-items-start w-100'>
                        <div class='col'>
                            <form method='get'>
                                <h1>Ajouter un item</h1>
                                <br>
                                <div class='mb-3'>
                                    <label class='form-label'>Nom de l'item</label>
                                </div>
                                <input type='text' name='nomIt'>
                                <br>
                                <br>
                                <div class='mb-3'>
                                    <label class='form-label'>Description de l'item</label>
                                </div>
                                <input type='text' name='descr'>
                                <br>
                                <br>
                                <div class='mb-3'>
                                    <label class='form-label'>image</label>
                                </div>
                                <input type='text' name='img'>
                                <br>
                                <br>
                                <div class='mb-3'>
                                    <label class='form-label'>url</label>
                                </div>
                                <input type='text' name='url'>
                                <br>
                                <br>
                                <div class='mb-3'>
                                    <label class='form-label'>tarif</label>
                                </div>
                                <input type='text' name='tarif'>
                                <br>
                                <br>
                                <input type='submit' name='submit'>
                            </form>
                        </div>
                        <div class='col'>
                            <h1>Suppression de la liste</h1>
                            <form method='get'>
                                 <div class='mb-3'>
                                    <label class='form-label'>Entrez votre mot de passe pour confirmer</label>
                                </div>
                                <input type='password' name='pswd'>
                                <br>
                                <br>
                                <input type='submit' name='sub'>
                            </form>
                            <br>
                            <h1>Modification</h1>
                            <form method='get'>
                                <div class='mb-3'>
                                    <label class='form-label'>Nom</label>
                                </div>
                                <input type='text' name='newName'>
                                <input type='submit' name='subName'>
                            </form>
                                <br>
                            <form method='get'>
                                <div class='mb-3'>
                                    <label class='form-label'>description</label>
                                </div>
                                <input type='text' name='descri'>
                                <input type='submit' name='subDescr'>
                            </form>
                                <br>
                            <form method='get'>
                                <div class='mb-3'>
                                    <label class='form-label'>date</label>
                                </div>
                                <input type='date' name='date'>
                                <input type='submit' name='subDate'>
                            </form>
                                <br>
                            <form method='get'>
                                 <div class='mb-3'>
                                    <label class='form-label'>commentaire</label>
                                </div>
                                <input type='text' name='comment'>
                                <input type='submit' name='subCom'>
                            </form>
                        </div>
                    </div>";

        if(isset($_GET['submit'])){
            Authentication::init();
            $pdo = Authentication::$connexion;
            $query = "Select no from liste where token = ? ";
            $st = $pdo->prepare($query);
            $st->execute([$token]);
            $row = $st->fetch(PDO::FETCH_ASSOC);
            $idlis = $row['no'];
            $query2 = "Select Max(id) as 'id' from item";
            $st = $pdo->prepare($query2);
            $st->execute();
            $row = $st->fetch(PDO::FETCH_ASSOC);
            $id = $row['id']+1;
            $query3 = "insert into item values(?,?,?,?,?,?,?)";
            $st =  $pdo->prepare($query3);
            $st->execute([$id,$idlis,$_GET['nomIt'],$_GET['descr'],$_GET['img'],$_GET['url'],$_GET['tarif']]);
        }

        if(isset($_GET['sub'])){
            Authentication::init();
            $pdo = Authentication::$connexion;
            $mdp = hash('md5',$_GET['pswd']);
            $query2 = 'Select passwd from users where uid = ?';
            $st2 = $pdo->prepare($query2);
            $st2->execute([$_SESSION['profile']['userid']]);
            $row = $st2->fetch(PDO::FETCH_ASSOC);
            if($mdp != $row['passwd']){
                echo "<script>alert(\"Le mot de passe ne correspond pas\")</script>";
            }else{
                $query3 = "delete from liste where token = ?";
                $pdo->prepare($query3)->execute([$token]);
                return (
                $response->withRedirect($this->c->router->pathfor('home'))
                );
            }
        }

        if (isset($_GET['subName'])){
            Authentication::init();
            $pdo = Authentication::$connexion;
            $query4 = "Update liste set titre = ? where token = ?";
            $pdo->prepare($query4)->execute([$_GET['newName'],$token]);
        }

        if (isset($_GET['subDescr'])){
            Authentication::init();
            $pdo = Authentication::$connexion;
            $query4 = "Update liste set description = ? where token = ?";
            $pdo->prepare($query4)->execute([$_GET['descri'],$token]);
        }

        if (isset($_GET['subDate'])){
            Authentication::init();
            $pdo = Authentication::$connexion;
            $query4 = "Update liste set expiration = ? where token = ?";
            $pdo->prepare($query4)->execute([$_GET['date'],$token]);
        }

        if (isset($_GET['subCom'])){
            Authentication::init();
            $pdo = Authentication::$connexion;
            $query4 = "Update liste set commentaire = ? where token = ?";
            $pdo->prepare($query4)->execute([$_GET['comment'],$token]);
        }



        return(
          $vue->getNav()."<body>$ajoutIt</body>".$vue->getFooter()
        );
    }
}