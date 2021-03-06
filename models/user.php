<?php

//echo $toto;

function findOneUserBy($critere,$value) {
    // SQL
    // Récupération de la variable > située dans le fichier db_connect.php > fichier qui sera appelé via register.php
    global $db;
//    $sql = "SELECT * FROM users WHERE email = 'm.de.ubeda@gmail.com'";
//    $sql = "SELECT * FROM users WHERE nom = 'l\'oiseau'";

    $sql = "SELECT * FROM users WHERE $critere = :value";
//    echo $sql;
//    die();
//    $sql = "SELECT * FROM users WHERE $critere = '$value'";
    // Préparer la requête
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":value",$value,PDO::PARAM_STR);
    // Exécuter la requête
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultat = $stmt->fetchAll();
    //echo '<pre>';
    //var_dump($resultat);
    //echo '</pre>';
    return $resultat;
}

function  addUser(array $datas) {
    global $db;
    $sql = "INSERT INTO users (login,email,password,prenom,nom,is_admin,created_at) VALUES
    (:login,:email,:password,:prenom,:nom,:is_admin,:created_at)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":login",$datas['login'], PDO::PARAM_STR);
    $stmt->bindParam(":email",$datas['email'], PDO::PARAM_STR);
    $stmt->bindParam(":password",password_hash($datas['password'], PASSWORD_ARGON2I),PDO::PARAM_STR);
    $stmt->bindParam(":nom",$datas['nom'], PDO::PARAM_STR);
    $stmt->bindParam(":prenom",$datas['prenom'], PDO::PARAM_STR);
    $stmt->bindValue(":is_admin",0, PDO::PARAM_BOOL);
    $stmt->bindParam(":created_at",date('y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->execute();


}
function findAllUsers() {
    global $db;

    //var_dump($stmt);
    //die();

    $sql = "SELECT * FROM users";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultat = $stmt->fetchAll();
    return $resultat;
}