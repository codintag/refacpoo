<?php

/**
 * retourne une connexion à la base de données
 * 
 * @return PDO
 */

function getPdo(): PDO{
    $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
}

/**
 * retourne la listedes articles classés par date de création
 * @return array
 */

function findAllArticles() : array {
    $pdo = getPdo();
    // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
    $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
    // On fouille le résultat pour en extraire les données réelles
    $articles = $resultats->fetchAll();

    return $articles;
}

function findArticle(int $id) : array {
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
    // On exécute la requête en précisant le paramètre :article_id 
    $query->execute(['article_id' => $id]);
    // On fouille le résultat pour en extraire les données réelles de l'article
    $article = $query->fetch();

    return $article;
}

function findAllComments(int $article_id) : array
{
    $pdo = getPdo();

    $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
    $query->execute(['article_id' => $article_id]);
    $commentaires = $query->fetchAll();

    return $commentaires;
}

