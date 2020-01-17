<?php

require 'Database.php';


if(isset($_POST) && !empty($_POST)){
    if(isset($_POST['pseudo']) && isset($_POST['mdp'])){
        $pseudo = htmlspecialchars($_POST['pseudo']); // On récupère le pseudo
        $mdp = htmlspecialchars($_POST['mdp']); // On récupère le password

        $connect = Database::getInstance();
        $connect->setIni("db.ini");

        $query = $connect->query("SELECT id, password FROM user WHERE pseudo='" . $pseudo . "';")->fetch(); // On récupère le hash du mot de passe en database

        if(hash("SHA512", $mdp) === $query['password']){ // Si les deux correspondent
            session_start(); // On lance la session
            $_SESSION['pseudo'] = $pseudo; // On stocke le pseudo en session
            $_SESSION['id'] = $query['id']; // On stocke le pseudo en session
            die(var_dump($_SESSION));
            header("Location: ../frontend/user.html"); // On redirige vers la page utilisateur
        }else{
            echo "Les identifiants sont incorrects !";
        }
    }
}
