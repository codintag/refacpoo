<?php

$commentaires = $model->findAll();
$commentaire = $model->find(1);
$model->delete(1);


class Database {

    private static $instance = null;
    /**
 * retourne une connexion à la base de données
 * 
 * @return PDO
 */

public static function getPdo(): PDO {
//singleeton...
    if(self::$instance === null)
    {
        self::$instance = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    return self::$instance;
}
}











