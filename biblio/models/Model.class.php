<?php

abstract class Model{
    // private accessible classe presente
    private static $pdo;

    private static function setBdd(){
        self::$pdo=new PDO("mysql:host=localhost;dbname=biblio;charset=utf8","root","");
        // Pour gerer les erreurs, constantes dispo
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }
    // protected acceesible classes filles
    protected function getBdd(){
        if(self::$pdo===null){
            self::setBdd();
        }
        return self::$pdo;
    }
}

?>