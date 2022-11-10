<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // INCLUDING DATABASE AND MAKING OBJECT
    // bdd : loginjson --- table : users ---- fields : Id, Login, Passwd

    require 'PDO.php' ;
    $myResponse =new stdClass() ;
    $pdo = new PDOdataBase('loginjson','localhost','root','' );

    if($pdo->connect())
    {
        if( isset($_POST['userName']) && isset($_POST['passWord']) )
        {
            $pdo->prepare("select * from users where Login=:loginName and Passwd=:passWord");
            $pdo->bind(':loginName', $_POST['userName']);
            $pdo->bind(':passWord' , $_POST ['passWord']);
            $pdo->execute() ;

            // on prépare la réponse
            if($pdo->rowCount()==1)
                $myResponse->message = "OK";
            else
                $myResponse->message = " Identifiant ou mot de passe incorrects !... ";
        }
        else{
            // on prépare la réponse
            $error = $pdo->getError() ;
            if ($error !="")
                $myResponse->message = $error; // erreur retournée par Mysql
            else
                $myResponse->message = "'userName' and/or 'passWord' missing ";
        }
    }
    else
    {
        $myResponse->message = $pdo->getError();
    }
    // on retourne la réponse    
    $myJsonResponse = json_encode($myResponse);
    echo $myJsonResponse ; // renvoi vers la page de login
?>