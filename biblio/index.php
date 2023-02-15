<?php 
session_start();

// definie la constante URL
define("URL",str_replace("index.php","",(isset($_SERVER["HTTPS"])?"https":"http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

// recup le fichier controller des livres
require_once "controllers/livresController.php";
$livreController=new LivresController;

// système de routage : focntionne avec url



try{
    // si lutilisateur est nulle part dans url page accueil
    if(empty($_GET["page"])){
        require "views/accueil.view.php";
    }
    // permet de gerer le chgment de page quand utilisateur est deja dans une autre page
    else{
        $url=explode("/",filter_var($_GET["page"],FILTER_SANITIZE_URL));

        // on test premier element de url
        switch($url[0]){
            case"accueil" : require "views/accueil.view.php";
            break;
            case"livres" :
            // si on a rien en tant que 2ème élément dans mon URL
                if(empty($url[1])){
                    $livreController->afficherLivres();
                }else if($url[1]==="l"){
                    // afficher le livre concerner
                    $livreController->afficherLivre((int)$url[2]);
                }else if($url[1]==="a"){
                    $livreController->ajoutLivre();
                }else if($url[1]==="m"){
                    $livreController->modificationLivre((int)$url[2]);
                }else if($url[1]==="s"){
                    $livreController->suppressionLivre((int)$url[2]);
                }else if($url[1]==="av"){
                    $livreController->ajoutLivreValidation();
                }elseif($url[1]==="mv"){
                    $livreController->modificationLivreValidation();
                }else{
                    // lever l'erreur si page nexiste pas
                    throw new Exception("La page n'existe pas");
                }
            break;
            // c'est une sorte de else ! De plus on lève lerreur
            default : throw new Exception("La page n'existe pas");
        }
    }
}catch(Exception $e){   //permet dafficher le message
    echo $e->getMessage();
}
