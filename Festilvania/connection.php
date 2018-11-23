<?php

class Connection {

    public static $bdd;

    public function __construct() {

    }

    public static function initConnection() {
        self::$bdd = new PDO('mysql:host=localhost;dbname=festilvania', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

}

?>