<?php
namespace wishlist\Vue;

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

    function ajout($token = null){
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



        return(
          $vue->getNav()."<body>$ajoutIt</body>".$vue->getFooter()
        );
    }
}