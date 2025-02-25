<?php

// Informations de connexion à la base de données
$host = "localhost";
$dbname = "mytech";
$user = "root";
$pass = "";

try {
    // création d'une instance PDO
    // les deux trucs pour faire lien php avec DB c'est mySQLi et PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // configuration de PDO en cas d'exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // s'il y a une erreur de connexion
    die("Erreur de connexion : " . $e->getMessage());
}

?>