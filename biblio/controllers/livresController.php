<?php
require_once "models/LivreManager.class.php";

class LivresController {
    private $livreManager;

    public function __construct(){
        // on instancie et charge les livres
        $this->livreManager=new LivreManager;
        $this->livreManager->chargementLivres();
    }
    
    public function afficherLivres(){
        // $livres recup le tableau des livres
        $livres=$this->livreManager->getLivres();
        require "views/livres.view.php";
        // qd on require, tous ce qui est declarer ds fonction et va dans require
    }

    public function afficherLivre($id){
        $livre=$this->livreManager->getLivreById($id);
        require "views/afficherLivre.view.php";
    }

    public function ajoutLivre(){
        require "views/ajoutLivre.view.php";
    }

    public function ajoutLivreValidation(){
        // charge image
        $file=$_FILES["image"];
        // ajouter image au image public
        $repertoire="public/images/";
        $nomImageAjoute= $this->ajoutImage($file,$repertoire);
        // ajouter le livre en bdd
        $this->livreManager->ajoutLivreBd($_POST["Titre"],$_POST["nbPages"],$nomImageAjoute);

        $_SESSION['alert']= [
            "type"=> "success",
            "msg"=> "Ajout Réalisé"
        ];
        // redirige lutilisateur vers la pages des livres
        header("Location: ".URL."livres");
    }

    private function ajoutImage($file, $dir){

        // si la personne a oublier choisir un fichier
        if(!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");

        // sil y a pas de dossier on le cree
        // 0777 ce sont des droit
        if(!file_exists($dir)) mkdir($dir,0777);

        // recup extension fichier
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        // ajout numero fichier generer aleatoire (eviter dooublons)
        $random = rand(0,99999);
        // genere nom fichier
        $target_file = $dir.$random."_".$file['name'];

        // verifie si bien une image
        if(!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        // verifie extension
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        // verifie si existe pas deja
        if(file_exists($target_file))
            throw new Exception("Le fichier existe déjà");
        // verifie taille
        if($file['size'] > 500000)
            throw new Exception("Le fichier est trop gros");
        // si pas reusssi a ajouter image
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        //  si functionne dit nom image qui a été ajouter
        else return ($random."_".$file['name']);
    }

    public function suppressionLivre($id){
        $nomImage= $this->livreManager->getLivreById($id)->getImage();
        // retire l'image de mon dossier
        unlink("public/images/".$nomImage);
        // supprime ds bdd
        $this->livreManager->suppressionLivreBd($id);
        $_SESSION['alert']= [
            "type"=> "success",
            "msg"=> "Supression Réalisé"
        ];
        // redirige lutilisateur vers la pages des livres
        header("Location: ".URL."livres");
    }

    public function modificationLivre($id){
        $livre=$this->livreManager->getLivreById($id);
        require "views/modifierLivre.view.php";
    }

    public function modificationLivreValidation(){
        $imageActuelle = $this->livreManager->getLivreById((int)$_POST['identifiant'])->getImage();
        $file = $_FILES['image'];

        if($file['size']>0){
            unlink("public/images/".$imageActuelle);
            $repertoire="public/images/";
            $nomImageTooAdd= $this->ajoutImage($file,$repertoire);
        }
        else{
            $nomImageTooAdd = $imageActuelle;
        }
        $this->livreManager->modificationLivreBD((int)$_POST['identifiant'],$_POST['titre'],$_POST['nbPages'],$nomImageTooAdd);
        $_SESSION['alert']= [
            "type"=> "success",
            "msg"=> "Modification Réalisé"
        ];
        header("Location: ".URL."livres");
    }
}

?>