<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require 'PDO.php';
    $myResponse = new stdClass();
    $pdo = new PDOdataBase('loginjson','localhost','root','' );
    // on teste si nos variables sont définies
    if($pdo->connect())
    {
        if ( isset($_POST['login']) && isset($_POST['pwd']) && isset($_POST['email']) && isset($_POST['sexe'])) 
        {
            // on récupère les valeurs des champs du formulaire
            $login = $_POST['login'] ;
            $pwd = $_POST['pwd'] ;
            $email = $_POST['email'] ;
            $sexe = $_POST['sexe'];
    
            // on va vérifier si l'enregistrement existe dans users;
            $pdo->prepare("SELECT * FROM users WHERE Login=? and Passwd=?");
            $pdo->bind(1, $login);
            $pdo->bind(2, $pwd);
            $pdo->execute();  // execute + un fetchull
            if($pdo->rowCount()==0)
            {
                $pdo->prepare("insert into users values(NULL,?,?,?,?)");
                $pdo->bind(1, $login) ;
                $pdo->bind(2, $pwd) ;
                $pdo->bind(3, $email) ;
                $pdo->bind(4, $sexe) ;
                if($pdo->execute())
                    $myResponse->message = "OK";
                else
                    $myResponse->message = $pdo->getError();
            }
            else{
                $myResponse->message = "Cette utilisateur est déjà existant !";
            }
        }
        else{
            $myResponse->message = "Il me manque des paramètres!";
        }
    }
    else{
        $myResponse->message = $pdo->getError();
    }
  

    // on retourne la réponse    
    $myJsonResponse = json_encode($myResponse);
    echo $myJsonResponse ; // renvoi vers la page de login
?>